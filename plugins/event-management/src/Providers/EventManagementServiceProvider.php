<?php

namespace Mojahid\EventManagement\Providers;

use Juzaweb\CMS\Support\ServiceProvider;
use Juzaweb\CMS\Facades\ActionRegister;
use Mojahid\EventManagement\Actions\ConfigAction;
use Mojahid\EventManagement\Actions\EventManagementAction;
use Mojahid\EventManagement\Actions\MenuAction;
use Mojahid\EventManagement\Supports\BookingManager;
use Juzaweb\CMS\Support\Payment;
use Mojahid\EventManagement\Models\EventBooking;
use Mojahid\EventManagement\Observers\BookingObserver;

class EventManagementServiceProvider extends ServiceProvider
{
    public function boot()
    {   
        EventBooking::observe(BookingObserver::class);
        
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
        $this->app->singleton(BookingManager::class, function ($app) {
            return new BookingManager($app->make(Payment::class));
        });
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
