<?php

namespace Mojar\Example\Providers;

use Mojar\CMS\Facades\ActionRegister;
use Mojar\CMS\Support\ServiceProvider;
use Mojar\Example\Actions\ExampleAction;

class ExampleServiceProvider extends ServiceProvider
{
    public function boot()
    {
        // Register Plugin Action
        ActionRegister::register([ExampleAction::class]);
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
