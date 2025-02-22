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
}
