<?php

namespace Mojarsoft\DevTool\Providers;

use Juzaweb\CMS\Support\ServiceProvider;
use Mojarsoft\DevTool\Actions\DevToolAction;
use Juzaweb\CMS\Facades\ActionRegister;

class DevToolServiceProvider extends ServiceProvider
{
    public function boot()
    {
        // Register Plugin Action
        ActionRegister::register([DevToolAction::class]);
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
