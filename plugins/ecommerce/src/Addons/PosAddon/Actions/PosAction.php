<?php 

namespace Mojahid\Ecommerce\Addons\PosAddon\Actions;

use Mojahid\Ecommerce\Models\Product;
use Juzaweb\CMS\Abstracts\Action;
use Juzaweb\CMS\Facades\HookAction;
use Illuminate\Support\Arr;
use Mojahid\Ecommerce\Http\Resources\PaymentMethodCollectionResource;
use Mojahid\Ecommerce\Models\PaymentMethod;
use Mojahid\Ecommerce\Supports\Manager\CurrencyManager;
use Illuminate\Support\Facades\Route;

class PosAction extends Action
{
    public function handle(): void
    {
        $this->addAction(self::BACKEND_INIT, [$this, 'registerPosAdminPage']);
        $this->addAction(self::INIT_ACTION, [$this, 'registerPosRoutes']);

        $this->addAction(
            Action::BACKEND_INIT,
            [$this, 'addAdminMenusForPos']
        );
    }

    public function registerPosRoutes()
    {
        Route::group([
            'prefix' => 'app/pos',
            'middleware' => ['web', 'auth'],
        ], function() {
            Route::get('/', function() {
                return 'Hello World';
                // return view('ecommerce::addons.pos.index');
            });
            // Route::post('/create-order', [PosController::class, 'createOrder'])->name('pos.create_order');
            // etc...
        });
    }

    public function registerPosAdminPage()
    {
        HookAction::registerAdminPage(
            'ecommerce.pos',
            [
                'title' => __('POS'),
                'menu' => [
                    'parent'   => 'ecommerce', // or 'event-management' etc.
                    'icon'     => 'fa fa-cash-register',
                    'position' => 60,
                ],
            ]
        );
    }

    public function addAdminMenusForPos(): void
    {
        HookAction::registerAdminPage(
            'ecommerce.pos',
            [
                'title' => trans('ecomm::content.ecommerce'),
                'menu' => [
                    'icon' => '<svg xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-brand-shopee"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M4 7l.867 12.143a2 2 0 0 0 2 1.857h10.276a2 2 0 0 0 2 -1.857l.867 -12.143h-16z" /><path d="M8.5 7c0 -1.653 1.5 -4 3.5 -4s3.5 2.347 3.5 4" /><path d="M9.5 17c.413 .462 1 1 2.5 1s2.5 -.897 2.5 -2s-1 -1.5 -2.5 -2s-2 -1.47 -2 -2c0 -1.104 1 -2 2 -2s1.5 0 2.5 1" /></svg>',
                    'position' => 12,
                ]
            ]
        );
    }
    
}
