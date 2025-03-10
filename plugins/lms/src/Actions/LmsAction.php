<?php

namespace Mojahid\Lms\Actions;

use Juzaweb\CMS\Abstracts\Action;
use Juzaweb\CMS\Facades\HookAction;
use Illuminate\Support\Arr;
use Juzaweb\CMS\Models\Role;

class LmsAction extends Action
{
    public function handle(): void
    {
        $this->addAction(
            Action::INIT_ACTION,
            [$this, 'registerConfigs']
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

        /**
         * Convert and format price
         */
        $this->addFilter(
             'lms.format_price',
             [$this, 'convertAndFormatPrice'],
             20,
             2
        );

        $this->addAction(
            Action::FRONTEND_CALL_ACTION,
            [$this, 'registerFrontendAjaxs']
        );

    }



    public function registerConfigs(): void
    {
        HookAction::registerConfig(
            [
                '_checkout_page',
                '_thanks_page',
            ]
        );
    }

    public function addCheckoutPage($view, $page): string
    {
        $checkoutPage = get_config('_checkout_page');
        $thanksPage = get_config('_thanks_page');


        if ($checkoutPage == $page->id) {
            return 'lms::frontend.checkout.index';
        }

        if ($thanksPage == $page->id) {
            return 'lms::frontend.checkout.thankyou';
        }

        return $view;
    }

    public function addCheckoutParams($params, $page)
    {
        $checkoutPage = get_config('_checkout_page');
        $thanksPage = get_config('_thanks_page');
        if ($checkoutPage == $page->id) {
            $methods = PaymentMethod::active()->get();
            return array_merge($params, [
                'payment_methods' => $methods->map(function($method) {
                    return [
                        'id' => $method->id,
                        'type' => $method->type,
                        'name' => $method->name,
                        'description' => $method->description,
                        'image' => $method->image
                    ];
                })->toArray()
            ]);
        }
        // add title
        if ($thanksPage == $page->id) {
            $params['title'] = 'Thank you';
            $orderToken = request()?->segment(2);

            abort_if($orderToken === null, 404);

            $order = Order::findByToken($orderToken);

            abort_if($order === null, 404);

            $order->load(['orderItems', 'paymentMethod']);
            // $order->loadExists(['downloadableProducts']);
            $params['order'] = OrderResource::make($order)->toArray(request());
        }

        return $params;
    }

    /**
     * Convert and format price
     */
    public function convertAndFormatPrice($formatted, $basePrice = null)
    {
        return app(CurrencyManager::class)->formatPrice(
            app(CurrencyManager::class)->convertPrice($basePrice)
        );
    }

    public function registerFrontendAjaxs(): void
    {
        HookAction::registerFrontendAjax(
            'checkout.lms',
            [
                'callback' => [FrontendCheckoutController::class, 'checkout'],
                'method' => 'POST',
            ]
        );
    }

}
