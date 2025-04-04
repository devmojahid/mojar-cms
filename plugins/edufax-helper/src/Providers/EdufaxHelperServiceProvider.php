<?php

namespace Mojahid\EdufaxHelper\Providers;

use Illuminate\Support\ServiceProvider;
use Juzaweb\CMS\Facades\ActionRegister;
use Mojahid\EdufaxHelper\Actions\EdufaxHelperAction;
use TwigBridge\Facade\Twig;
use Mojahid\EdufaxHelper\Extensions\TwigExtension;

class EdufaxHelperServiceProvider extends ServiceProvider
{
    /**
     * Boot the application events.
     *
     * @return void
     */
    public function boot()
    {
        Twig::addExtension(new TwigExtension());

        ActionRegister::register([
            EdufaxHelperAction::class,
        ]);
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        // Register additional services if needed
    }
} 