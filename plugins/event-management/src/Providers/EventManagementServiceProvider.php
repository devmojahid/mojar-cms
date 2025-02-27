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
use Mojahid\EventManagement\Listeners\OrderCreatedListener;
use Mojahid\Ecommerce\Models\Order;
use Mojahid\EventManagement\Observers\OrderObserver;

class EventManagementServiceProvider extends ServiceProvider
{
    public function boot()
    {
        EventBooking::observe(BookingObserver::class);
        Order::observe(OrderObserver::class);

        // Create instance of listener instead of using static call
        $orderListener = new OrderCreatedListener();
        // do_action('ecomm.after.save.order', $order, $items, $user);
        add_action('ecomm.after.save.order', [$orderListener, 'handle']);

        // add_action('ecomm.after.save.order', [OrderCreatedListener::class, 'handle'], 10, 3);

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
