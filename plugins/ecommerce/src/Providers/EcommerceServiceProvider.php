<?php

namespace Mojahid\Ecommerce\Providers;

use Juzaweb\CMS\Support\ServiceProvider;
use Juzaweb\CMS\Facades\ActionRegister;
use Juzaweb\CMS\Facades\MacroableModel;
use Juzaweb\CMS\Support\Payment;
use Mojahid\Ecommerce\Actions\ConfigAction;
use Mojahid\Ecommerce\Actions\EcommerceAction;
use Mojahid\Ecommerce\Actions\MenuAction;
use Mojahid\Ecommerce\Contracts\CartContract;
use Mojahid\Ecommerce\Contracts\CartManagerContract;
use Mojahid\Ecommerce\Contracts\OrderCreaterContract;
use Mojahid\Ecommerce\Contracts\OrderManagerContract;
use Mojahid\Ecommerce\Supports\Creaters\OrderCreater;
use Mojahid\Ecommerce\Supports\Manager\AddonManager;
use Mojahid\Ecommerce\Supports\Manager\CartManager;
use Mojahid\Ecommerce\Supports\Manager\OrderManager;
use Mojahid\Ecommerce\Repositories\CartRepository;
use Mojahid\Ecommerce\Repositories\CartRepositoryEloquent;
use Mojahid\Ecommerce\Repositories\ProductRepository;
use Mojahid\Ecommerce\Repositories\ProductRepositoryEloquent;
use Mojahid\Ecommerce\Repositories\VariantRepositoryEloquent;
use Juzaweb\Backend\Models\Post;
use Mojahid\Ecommerce\Actions\EcommercePostTypeAction;
use Mojahid\Ecommerce\Models\Order;
use Mojahid\Ecommerce\Models\OrderItem;
use Mojahid\Ecommerce\Models\ProductVariant;
use Mojahid\Ecommerce\Http\Middleware\EcommerceTheme;
use Illuminate\Support\Facades\Route;

class EcommerceServiceProvider extends ServiceProvider
{
    public array $bindings = [
        CartRepository::class => CartRepositoryEloquent::class,
        VariantRepositoryEloquent::class => VariantRepositoryEloquent::class,
        ProductRepository::class => ProductRepositoryEloquent::class,
    ];

    public function boot()
    {
        Route::pushMiddlewareToGroup('theme', EcommerceTheme::class);

        ActionRegister::register([
            EcommerceAction::class,
            MenuAction::class,
            ConfigAction::class,
        ]);

        if (get_config('ecom_enable_products', true)) {
            ActionRegister::register([
                EcommercePostTypeAction::class,
            ]);
        }

        // $addonManager = app(AddonManager::class);
        // $addonManager->loadAddons();
        // $addonManager->initAddons();

        MacroableModel::addMacro(
            Post::class,
            'orderItems',
            function () {
                /**
                 * @var Post $this
                 */
                return $this->hasMany(
                    OrderItem::class,
                    'product_id',
                    'id'
                );
            }
        );

        MacroableModel::addMacro(
            Post::class,
            'orders',
            function () {
                /**
                 * @var Post $this
                 */
                return $this->belongsToMany(
                    Order::class,
                    OrderItem::getTableName(),
                    'product_id',
                    'order_id'
                );
            }
        );

        MacroableModel::addMacro(
            Post::class,
            'variants',
            function () {
                /**
                 * @var Post $this
                 */
                return $this->hasMany(
                    ProductVariant::class,
                    'post_id',
                    'id'
                );
            }
        );

        $this->publishes([
            __DIR__.'/../resources/assets' => public_path('jw-styles/plugins/juzaweb/ecommerce/assets'),
            __DIR__.'/../resources/assets/css/images' => public_path('jw-styles/plugins/juzaweb/ecommerce/assets/css/images'),
        ], 'ecommerce-assets');

        // Ensure the directory exists
        if (!file_exists(public_path('jw-styles/plugins/juzaweb/ecommerce/assets/css/images'))) {
            mkdir(public_path('jw-styles/plugins/juzaweb/ecommerce/assets/css/images'), 0755, true);
        }

        add_action('theme.header', function() {
            echo '<script>window.ecommerceConfig = ' . json_encode([
                'routes' => [
                    'checkout' => route('ecomm.checkout.store'),
                    'update' => route('ecomm.checkout.update'),
                ],
                'csrf_token' => csrf_token(),
            ]) . ';</script>';
        });
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register(): void
    {
        $this->mergeConfigFrom(
            __DIR__.'/../../config/ecommerce.php',
            'ecommerce'
        );

        $this->app->singleton(
            CartManagerContract::class,
            function () {
                return new CartManager();
            }
        );

        $this->app->bind(
            CartContract::class,
            config('ecommerce.cart')
        );

        $this->app->singleton(
            OrderCreaterContract::class,
            OrderCreater::class
        );

        $this->app->singleton(
            OrderManagerContract::class,
            function ($app) {
                return new OrderManager(
                    $app[OrderCreaterContract::class],
                    app(Payment::class)
                );
            }
        );
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return [];
    }
}
