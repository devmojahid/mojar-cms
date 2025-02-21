<?php

namespace Mojahid\Ecommerce\Actions;

use Juzaweb\CMS\Abstracts\Action;
use Juzaweb\CMS\Facades\HookAction;
use Mojahid\Ecommerce\Models\Order;
use Mojahid\Ecommerce\Http\Resources\OrderResource;

class MenuAction extends Action

{
    public function handle(): void
    {
        $this->addAction(
            Action::BACKEND_INIT,
            [$this, 'addAdminMenus']
        );

        $this->addAction(
            Action::FRONTEND_INIT,
            [$this, 'addProfilePages']
        );
    }

    public function addAdminMenus(): void
    {
        HookAction::registerAdminPage(
            'ecommerce',
            [
                'title' => trans('ecomm::content.ecommerce'),
                'menu' => [



                    'icon' => '<svg xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-brand-shopee"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M4 7l.867 12.143a2 2 0 0 0 2 1.857h10.276a2 2 0 0 0 2 -1.857l.867 -12.143h-16z" /><path d="M8.5 7c0 -1.653 1.5 -4 3.5 -4s3.5 2.347 3.5 4" /><path d="M9.5 17c.413 .462 1 1 2.5 1s2.5 -.897 2.5 -2s-1 -1.5 -2.5 -2s-2 -1.47 -2 -2c0 -1.104 1 -2 2 -2s1.5 0 2.5 1" /></svg>',
                    'position' => 12,
                ]
            ]
        );

        HookAction::registerAdminPage(
            'ecommerce.orders',
            [
                'title' => trans('ecomm::content.orders'),
                'menu' => [
                    'icon' => '<svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-truck-delivery"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M7 17m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0" /><path d="M17 17m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0" /><path d="M5 17h-2v-4m-1 -8h11v12m-4 0h6m4 0h2v-6h-8m0 -5h5l3 5" /><path d="M3 9l4 0" /></svg>',
                    'position' => 5,
                    'parent' => 'ecommerce'
                ]
            ]
        );

        HookAction::registerAdminPage(
            'ecommerce.incomplete-orders',
            [
                'title' => trans('ecomm::content.incomplete_orders'),
                'menu' => [
                    'icon' => '<svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-basket-cancel"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M17 10l-2 -6" /><path d="M7 10l2 -6" /><path d="M12 20h-4.756a3 3 0 0 1 -2.965 -2.544l-1.255 -7.152a2 2 0 0 1 1.977 -2.304h13.999a2 2 0 0 1 1.977 2.304l-.3 1.713" /><path d="M10 14a2 2 0 1 0 4 0a2 2 0 0 0 -4 0" /><path d="M19 19m-3 0a3 3 0 1 0 6 0a3 3 0 1 0 -6 0" /><path d="M17 21l4 -4" /></svg>',
                    'position' => 6,
                    'parent' => 'ecommerce'
                ]
            ]
        );

        HookAction::registerAdminPage(
            'ecommerce.return-orders',
            [
                'title' => trans('ecomm::content.return_orders'),
                'menu' => [
                    'icon' => '<svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-basket-down"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M17 10l-2 -6" /><path d="M7 10l2 -6" /><path d="M12 20h-4.756a3 3 0 0 1 -2.965 -2.544l-1.255 -7.152a2 2 0 0 1 1.977 -2.304h13.999a2 2 0 0 1 1.977 2.304l-.349 1.989" /><path d="M10 14a2 2 0 1 0 4 0a2 2 0 0 0 -4 0" /><path d="M19 16v6" /><path d="M22 19l-3 3l-3 -3" /></svg>',
                    'position' => 7,
                    'parent' => 'ecommerce'
                ]
            ]
        );

        HookAction::registerAdminPage(
            'ecommerce.invoice',
            [
                'title' => trans('ecomm::content.invoice'),
                'menu' => [
                    'icon' => '<svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-invoice"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M14 3v4a1 1 0 0 0 1 1h4" /><path d="M19 12v7a1.78 1.78 0 0 1 -3.1 1.4a1.65 1.65 0 0 0 -2.6 0a1.65 1.65 0 0 1 -2.6 0a1.65 1.65 0 0 0 -2.6 0a1.78 1.78 0 0 1 -3.1 -1.4v-14a2 2 0 0 1 2 -2h7l5 5v4.25" /></svg>',
                    'position' => 8,
                    'parent' => 'ecommerce'
                ]
            ]
        );

        HookAction::registerAdminPage(
            'ecommerce.customers',
            [
                'title' => trans('ecomm::content.customers'),
                'menu' => [
                    'icon' => '<svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-users-group"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M10 13a2 2 0 1 0 4 0a2 2 0 0 0 -4 0" /><path d="M8 21v-1a2 2 0 0 1 2 -2h4a2 2 0 0 1 2 2v1" /><path d="M15 5a2 2 0 1 0 4 0a2 2 0 0 0 -4 0" /><path d="M17 10h2a2 2 0 0 1 2 2v1" /><path d="M5 5a2 2 0 1 0 4 0a2 2 0 0 0 -4 0" /><path d="M3 13v-1a2 2 0 0 1 2 -2h2" /></svg>',
                    'position' => 9,
                    'parent' => 'ecommerce'
                ]
            ]
        );


        HookAction::registerAdminPage(
            'ecommerce.settings',
            [
                'title' => trans('ecomm::content.settings'),
                'menu' => [


                    'icon' => '<svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-settings"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M10.325 4.317c.426 -1.756 2.924 -1.756 3.35 0a1.724 1.724 0 0 0 2.573 1.066c1.543 -.94 3.31 .826 2.37 2.37a1.724 1.724 0 0 0 1.065 2.572c1.756 .426 1.756 2.924 0 3.35a1.724 1.724 0 0 0 -1.066 2.573c.94 1.543 -.826 3.31 -2.37 2.37a1.724 1.724 0 0 0 -2.572 1.065c-.426 1.756 -2.924 1.756 -3.35 0a1.724 1.724 0 0 0 -2.573 -1.066c-1.543 .94 -3.31 -.826 -2.37 -2.37a1.724 1.724 0 0 0 -1.065 -2.572c-1.756 -.426 -1.756 -2.924 0 -3.35a1.724 1.724 0 0 0 1.066 -2.573c-.94 -1.543 .826 -3.31 2.37 -2.37c1 .608 2.296 .07 2.572 -1.065z" /><path d="M9 12a3 3 0 1 0 6 0a3 3 0 0 0 -6 0" /></svg>',
                    'position' => 50,
                    'parent' => 'ecommerce'
                ]
            ]
        );
    }

    public function addProfilePages(): void
    {
        // Dashboard
        HookAction::registerProfilePage(
            'dashboard',
            [
                'title' => trans('ecomm::content.dashboard'),
                'key' => 'dashboard',
                'contents' => view()->exists('theme::profile.dashboard.index') ? 'theme::profile.dashboard.index' : 'ecomm::frontend.profile.dashboard.index',
                'icon' => 'fa fa-home',
                'position' => 1,
            ]
        );

        HookAction::registerProfilePage(
            'orders',
            [
                'title' => trans('ecomm::content.orders'),
                'key' => 'orders',
                'contents' => view()->exists('theme::profile.orders.index') ? 'theme::profile.orders.index' : 'ecomm::frontend.profile.orders.index',
                'icon' => 'fa fa-shopping-cart',
                'position' => 10,
                'data' => [
                    'orders' => OrderResource::collection(
                        Order::with(['paymentMethod'])
                            ->paginate(10)
                    )->response()->getData(true),
                    'thank_page' => get_config('ecom_thanks_page')
                        ? get_page_url(get_config('ecom_thanks_page'))
                        : null
                ]
            ]
        );

        // Account
        HookAction::registerProfilePage(
            'account',
            [
                'title' => trans('ecomm::content.account'),
                'key' => 'account',
                'contents' => view()->exists('theme::profile.account.index') ? 'theme::profile.account.index' : 'ecomm::frontend.profile.account.index',
                'icon' => 'fa fa-user',
                'position' => 10,
                'data' => [
                    'user' => auth()->user()
                ]
            ]
        );

        HookAction::registerProfilePage(
            'change-password',
            [
                'title' => trans('ecomm::content.change_password'),
                'key' => 'change-password',
            ]
        );

        HookAction::registerProfilePage(
            'logout',
            [
                'title' => trans('ecomm::content.logout'),
                'key' => 'logout',
            ]
        );
    }
}
