<?php

namespace Mojahid\Ecommerce\Providers;

use Juzaweb\CMS\Support\ServiceProvider;
use Juzaweb\CMS\Facades\ActionRegister;
use Mojahid\Ecommerce\Actions\ConfigAction;
use Mojahid\Ecommerce\Actions\EcommerceAction;
use Mojahid\Ecommerce\Actions\MenuAction;
use Mojahid\Ecommerce\Supports\Manager\AddonManager;
class EcommerceServiceProvider extends ServiceProvider
{
    public function boot()
    {
        ActionRegister::register([
            EcommerceAction::class,
            MenuAction::class,
            ConfigAction::class,
        ]);

        $addonManager = app(AddonManager::class);
        $addonManager->loadAddons();
        $addonManager->initAddons();
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        //
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
