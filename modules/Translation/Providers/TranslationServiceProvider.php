<?php

namespace Mojar\Translation\Providers;

use Mojar\CMS\Facades\ActionRegister;
use Mojar\CMS\Support\ServiceProvider;
use Mojar\Translation\Contracts\TranslationContract;
use Mojar\Translation\Support\Locale;
use Mojar\Translation\TranslationAction;

class TranslationServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->loadViewsFrom(__DIR__ . '/../resources/views', 'translation');

        ActionRegister::register(TranslationAction::class);
    }

    public function register()
    {
        $this->app->register(RouteServiceProvider::class);

        $this->app->singleton(
            TranslationContract::class,
            function () {
                return new Locale();
            }
        );
    }
}
