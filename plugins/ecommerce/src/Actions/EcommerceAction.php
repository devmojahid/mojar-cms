<?php

namespace Mojahid\Ecommerce\Actions;

use Mojahid\Ecommerce\Models\Product;
use Juzaweb\CMS\Abstracts\Action;
use Juzaweb\CMS\Facades\HookAction;
use Illuminate\Support\Arr;
use Juzaweb\CMS\Http\Resources\PaymentMethodCollectionResource;
use Juzaweb\CMS\Models\PaymentMethod;
use Mojahid\Ecommerce\Supports\Manager\CurrencyManager;
use Mojahid\Ecommerce\Http\Controllers\Frontend\CartController as FrontendCartController;
use Mojahid\Ecommerce\Http\Controllers\Frontend\CheckoutController as FrontendCheckoutController;
use Mojahid\Ecommerce\Http\Resources\CartResource;
use Mojahid\Ecommerce\Supports\Manager\CartManager;
use Juzaweb\CMS\Models\Role;
use Mojahid\Ecommerce\Models\Currency;
use Mojahid\Ecommerce\Models\Order;
use Mojahid\Ecommerce\Http\Resources\OrderResource;

class EcommerceAction extends Action
{
    public function handle(): void
    {
        $this->addAction(
            Action::INIT_ACTION,
            [$this, 'registerConfigs']
        );

        $this->addAction(
            Action::INIT_ACTION,
            [$this, 'registerRoles']
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
             'ecommerce.format_price',
             [$this, 'convertAndFormatPrice'],
             20,
             2
        );

        $this->addAction(
            Action::FRONTEND_CALL_ACTION,
            [$this, 'registerFrontendAjaxs']
        );

        $this->addAction(
            'juzaweb.setting.save',
            [$this, 'saveSetting']
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
            return 'ecomm::frontend.checkout.index';
        }

        if ($thanksPage == $page->id) {
            return 'ecomm::frontend.checkout.thankyou';
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
                        'description' => $method->description
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
            // dd($order);
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
            'checkout',
            [
                'callback' => [FrontendCheckoutController::class, 'checkout'],
                'method' => 'POST',
            ]
        );

        HookAction::registerFrontendAjax(
            'cart.add-to-cart',
            [
                'callback' => [FrontendCartController::class, 'addToCart'],
                'method' => 'POST',
            ]
        );

        HookAction::registerFrontendAjax(
            'cart.get-items',
            [
                'callback' => [FrontendCartController::class, 'getCartItems'],
            ]
        );

        HookAction::registerFrontendAjax(
            'cart.remove-item',
            [
                'callback' => [FrontendCartController::class, 'removeItem'],
            ]
        );

        HookAction::registerFrontendAjax(
            'cart.update',
            [
                'callback' => [FrontendCartController::class, 'update'],
                'method' => 'POST',
                'name' => 'cart.update'
            ]
        );

        HookAction::registerFrontendAjax(
            'payment.cancel',
            [
                'callback' => [FrontendCheckoutController::class, 'cancel'],
            ]
        );

        HookAction::registerFrontendAjax(
            'payment.completed',
            [
                'callback' => [FrontendCheckoutController::class, 'completed'],
            ]
        );
    }

    /**
     * Register ecommerce specific roles and permissions
     */
    public function registerRoles(): void
    {
        // First register the permissions
        HookAction::registerResourcePermissions(
            'products',
            trans('ecommerce::content.products')
        );

        HookAction::registerResourcePermissions(
            'orders',
            trans('ecommerce::content.orders')
        );

        // Then create roles with those permissions
        $roles = [
            'customer' => [
                'name' => 'Customer',
                'description' => 'Ecommerce customer role',
                'permissions' => [
                    'orders.view_own',
                    'profile.edit',
                    'downloads.access'
                ]
            ],
            'shop_manager' => [
                'name' => 'Shop Manager',
                'description' => 'Can manage products and orders',
                'permissions' => [
                    'products.index',
                    'products.create',
                    'products.edit',
                    'products.delete',
                    'orders.index',
                    'orders.edit',
                    'orders.delete'
                ]
            ]
        ];

        foreach ($roles as $key => $role) {
            // Check if role already exists
            if (!Role::where('name', $key)->exists()) {
                $newRole = Role::create([
                    'name' => $key,
                    'description' => $role['description'],
                    'guard_name' => 'web'
                ]);

                // Sync permissions
                $newRole->syncPermissions($role['permissions']);
            }
        }
    }

    public function saveSetting($request)
    {
         // Save other config
        set_config('ecomm_enable_multi_currency', $request->input('ecomm_enable_multi_currency', 0));
        set_config('ecomm_allow_currency_switcher', $request->input('ecomm_allow_currency_switcher', 1));
        set_config('ecomm_force_checkout_currency', $request->input('ecomm_force_checkout_currency'));
        set_config('ecomm_exchange_rate_api', $request->input('ecomm_exchange_rate_api'));
        set_config('ecomm_exchange_rate_api_key', $request->input('ecomm_exchange_rate_api_key'));
        set_config('ecomm_auto_update_exchange', $request->input('ecomm_auto_update_exchange', 0));

            // Process currencies
            $currenciesData = $request->input('currencies', []);
            $defaultId = $request->input('default_currency_id');

            // reset old defaults
            Currency::where('is_default', true)->update(['is_default' => false]);

            foreach ($currenciesData as $rowId => $data) {
                if (is_numeric($rowId)) {
                    // existing
                    $currency = Currency::find($rowId);
                    if ($currency) {
                        $currency->code      = $data['code'] ?? $currency->code;
                        $currency->name              = $data['name'] ?? $currency->name;
                        $currency->symbol            = $data['symbol'] ?? $currency->symbol;
                        $currency->exchange_rate     = floatval($data['exchange_rate'] ?? 1);
                        $currency->is_enabled        = isset($data['is_enabled']);
                        $currency->is_default        = false;
                        $currency->save();
                    }
                } else {
                    // new currency
                    $currency = new Currency();
                    $currency->code      = $data['code'] ?? '';
                    $currency->name              = $data['name'] ?? '';
                    $currency->symbol            = $data['symbol'] ?? '';
                    $currency->exchange_rate     = floatval($data['exchange_rate'] ?? 1);
                    $currency->is_enabled        = isset($data['is_enabled']);
                    $currency->is_default        = false;
                    $currency->save();
                }
            }

            if ($defaultId) {
                $def = Currency::find($defaultId);
                if ($def) {
                    $def->is_default = true;
                    $def->save();
                }
            }

            return redirect()->back()->with('success', __('Settings saved.'));
    }
}
