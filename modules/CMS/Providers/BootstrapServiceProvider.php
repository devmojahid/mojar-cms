<?php

namespace Mojar\CMS\Providers;

use Illuminate\Support\ServiceProvider;
use Mojar\CMS\Contracts\LocalPluginRepositoryContract;
use Mojar\CMS\Facades\ActionRegister;
use Mojar\Frontend\Providers\RouteServiceProvider;

class BootstrapServiceProvider extends ServiceProvider
{
    /**
     * Booting the package.
     */
    public function boot(): void
    {
        $this->app[LocalPluginRepositoryContract::class]->boot();

        $this->booted(
            function () {
                ActionRegister::init();

                do_action('mojar.init');
            }
        );
    }

    /**
     * Register the provider.
     */
    public function register(): void
    {
        $this->app[LocalPluginRepositoryContract::class]->register();

        // Register frontend routes after load plugins
        $this->app->register(RouteServiceProvider::class);
    }
}
