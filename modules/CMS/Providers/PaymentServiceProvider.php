<?php

namespace Juzaweb\CMS\Providers;

use Juzaweb\CMS\Support\PaymentMethodManager;
use Juzaweb\CMS\Support\ServiceProvider;

class PaymentServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->singleton(PaymentMethodManager::class, function ($app) {
            return new PaymentMethodManager();
        });
    }

    public function boot()
    {
        // Register your gateways:
        $manager = $this->app->make(PaymentMethodManager::class);

        $manager->extend('paypal', function ($paymentMethod) {
            return new \Juzaweb\CMS\Support\Payments\Paypal($paymentMethod);
        });

        // $manager->extend('stripe', function ($paymentMethod) {
        //     return new \Juzaweb\CMS\Support\Payments\StripeGateway($paymentMethod);
        // });

        // ... and so forth
    }
}
