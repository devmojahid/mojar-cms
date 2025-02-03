<?php

namespace Mojahid\EventManagement\Providers;

use Juzaweb\CMS\Support\ServiceProvider;
use Juzaweb\CMS\Facades\ActionRegister;
use Mojahid\EventManagement\Actions\ConfigAction;
use Mojahid\EventManagement\Actions\EventManagementAction;
use Mojahid\EventManagement\Actions\MenuAction;

class EventManagementServiceProvider extends ServiceProvider
{
    public function boot()
    {
        ActionRegister::register([
            EventManagementAction::class,
            MenuAction::class,
            ConfigAction::class,

        ]);
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
