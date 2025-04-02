<?php

namespace Mojahid\EventManagement\Actions;

use Mojahid\EventManagement\Models\EventTicket;
use Juzaweb\CMS\Abstracts\Action;
use Juzaweb\CMS\Facades\HookAction;
use Illuminate\Support\Arr;
use Mojahid\Ecommerce\Http\Resources\PaymentMethodCollectionResource;
use Mojahid\Ecommerce\Models\PaymentMethod;

class EventManagementAction extends Action

{
    public function handle(): void
    {
        $this->addAction(
            Action::INIT_ACTION,
            [$this, 'registerPostTypes']
        );

        // $this->addAction(
        //     Action::INIT_ACTION,
        //     [$this, 'registerCustomEntities']
        // );


        $this->addAction(
            Action::INIT_ACTION,
            [$this, 'registerConfigs']
        );
        
        $this->addAction(
            'post_type.events.form.left',
            [$this, 'addFormEvent']
        );
        
        $this->addAction(
            'post_type.events.after_save',
            [$this, 'afterSaveEvent'],
            10,
            2
        );
        
        $this->addFilter(
            'post_type.events.parseDataForSave',
            [$this, 'parseDataForSave']
        );


        $this->addFilter(
            'theme.get_view_page',
            [$this, 'addCheckoutPage'],
            20,
            2
        );

        $this->addFilter(
            'theme.get_params_page',
            [$this, 'addCheckoutParams'],
            20,
            2
        );

    }

    /**
     * Register post types
     */
    public function registerPostTypes(): void
    {
        $eventInvisibleMetas = [
            'start_date',
            'end_date',
            'event_logo',
            'event_banner',
            'images',
            'social_links',
            'venue',
            'venue_address',
            'latitude',
            'longitude',
            'map_url',
            'map_embed_code',
        ];

        HookAction::registerPostType(
            'events',
            [
                'label' => trans('evman::content.events'),
                'menu_icon' => '<svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-calendar-check"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M11.5 21h-5.5a2 2 0 0 1 -2 -2v-12a2 2 0 0 1 2 -2h12a2 2 0 0 1 2 2v6" /><path d="M16 3v4" /><path d="M8 3v4" /><path d="M4 11h16" /><path d="M15 19l2 2l4 -4" /></svg>',
                'menu_position' => 10,
                'supports' => [
                    'category',
                    'tag'
                ],
                'metas' => collect($eventInvisibleMetas)
                    ->mapWithKeys(
                        fn ($item) => [$item => ['visible' => false]]
                    )

                    ->toArray(),
            ]
        );
    }

    public function addFormEvent($model): void
    {
        $eventTicket = EventTicket::findByEvent($model->id);
        
        if ($eventTicket === null) {
            $eventTicket = new EventTicket();
        }

        echo e(
            view(
                'evman::backend.event.form',

                [   
                    'model' => $model,
                    'eventTicket' => $eventTicket
                ]
            )
        );

    }

    public function parseDataForSave($data)
    {
        $metas = (array) $data['meta'];
        if ($metas['price']) {
            $metas['price'] = parse_price_format($metas['price']);
        }

        if ($metas['capacity']) {
            $metas['capacity'] = (int) $metas['capacity'];
            $metas['capacity'] = max($metas['capacity'], 0);
        }
        
        if ($metas['min_ticket_number']) {
            $metas['min_ticket_number'] = (int) $metas['min_ticket_number'];
        }
        
        if ($metas['max_ticket_number']) {
            $metas['max_ticket_number'] = (int) $metas['max_ticket_number'];
        }

        $data['meta'] = $metas;
        return $data;
    }

    public function afterSaveEvent($model, $data): void
    {
        if (Arr::has($data, 'meta')) {
            $eventTicket = EventTicket::findByEvent($model->id);
            $metas = (array) $data['meta'];
            $metas['description'] = seo_string(strip_tags($data['content']), 320);

            if( $eventTicket ){
                $eventTicket->update($metas);
            } else {
                $metas['event_id'] = $model->id;
                $eventTicket = EventTicket::create($metas);
            }
        }
    }

    public function registerConfigs(): void
    {
        HookAction::registerConfig(
            [
                'evman_checkout_page',
                'evman_thanks_page',
                'evman_store_address1',
                'evman_store_address2',
                'evman_city',
                'evman_country',
                'evman_zipcode',
                'evman_event_default_status',
                'evman_ticket_default_status',
                'evman_ticket_prefix',
                'evman_email_notification',
                'evman_booking_expiry_time',
                'evman_date_format',
                'evman_time_format',
            ]
        );
        
        $this->addAction(
            'juzaweb.setting.save',
            [$this, 'saveSetting']
        );
    }

    public function addCheckoutPage($view, $page): string
    {
        $checkoutPage = get_config('evman_checkout_page');
        $thanksPage = get_config('evman_thanks_page');


        if ($checkoutPage == $page->id) {
            return 'evman::frontend.checkout.index';
        }

        if ($thanksPage == $page->id) {
            return 'evman::frontend.checkout.thankyou';
        }

        return $view;
    }

    public function addCheckoutParams($params, $page)
    {
        $checkoutPage = get_config('evman_checkout_page');
        $thanksPage = get_config('evman_thanks_page');

        if ($checkoutPage == $page->id) {
            $methods = PaymentMethod::active()->get();

            $params['payment_methods'] = (new PaymentMethodCollectionResource($methods))->toArray(request());
        }

        // if ($thanksPage == $page->id) {
        //     $orderToken = request()?->segment(2);

        //     abort_if($orderToken === null, 404);

        //     $order = Order::findByToken($orderToken);

        //     abort_if($order === null, 404);

        //     $order->load(['orderItems', 'paymentMethod']);
        //     $order->loadExists(['downloadableProducts']);

        //     $params['order'] = OrderResource::make($order)->toArray(request());
        // }

        return $params;
    }




    public function registerCustomEntities()
    {
        // Register a custom post type called "my_events"
        HookAction::registerPostType('my_events', [
            'label'          => 'My Events',
            'supports'       => ['category','tag', 'comment'], 
            'rewrite'        => true,
            'menu_position'  => 6,
            'show_in_menu' => true,
            'menu_box'     => false,
            // Metas for the post type (automatically displayed in form.blade.php)

            'metas' => [
                'event_location' => [
                    'label'   => 'Event Location',
                    'type'    => 'text',
                    'visible' => true,
                    'sidebar' => false, // show in main area
                ],
                'event_date' => [
                    'label'   => 'Event Date',
                    'type'    => 'date',
                    'visible' => true,
                    'sidebar' => false,
                ],
            ],
        ]);

        // Register a taxonomy "industries" for "my_events"
        // This won't automatically display meta fields unless we handle it ourselves
        HookAction::registerTaxonomy('industries', 'my_events', [
            'label'        => 'Industries',
            'hierarchical' => true,
            'supports'     => ['hierarchical'], 
            'rewrite'      => true,
            'menu_box'     => true,
            // We can define metas here, but we must handle form rendering and saving
            'metas' => [
                'industry_icon' => [
                    'label'   => 'Industry Icon (URL)',
                    'type'    => 'image',
                    'visible' => true,
                ],
            ],
        ]);

        // Example of registering a config key for your plugin
        HookAction::registerConfig([
            'example_full_plugin_setting' => [
                'label'    => 'Example Plugin Setting',
                'type'     => 'text',
                'show_api' => true,
            ],
        ]);
    }

    /**
     * Handle saving event management plugin settings
     */
    public function saveSetting($request): void
    {
        // Store address settings
        set_config('evman_store_address1', $request->input('evman_store_address1'));
        set_config('evman_store_address2', $request->input('evman_store_address2'));
        set_config('evman_city', $request->input('evman_city'));
        set_config('evman_country', $request->input('evman_country'));
        set_config('evman_zipcode', $request->input('evman_zipcode'));
        
        // Event and ticket default settings
        set_config('evman_event_default_status', $request->input('evman_event_default_status', 'active'));
        set_config('evman_ticket_default_status', $request->input('evman_ticket_default_status', 'active'));
        set_config('evman_ticket_prefix', $request->input('evman_ticket_prefix', 'EVT-'));
        
        // Notification settings
        set_config('evman_email_notification', $request->input('evman_email_notification', 1));
        set_config('evman_booking_expiry_time', $request->input('evman_booking_expiry_time', 30));
        
        // Format settings
        set_config('evman_date_format', $request->input('evman_date_format', 'Y-m-d'));
        set_config('evman_time_format', $request->input('evman_time_format', 'H:i'));
        
        // Page settings
        set_config('evman_checkout_page', $request->input('evman_checkout_page'));
        set_config('evman_thanks_page', $request->input('evman_thanks_page'));
    }
}