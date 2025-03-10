<?php

namespace Mojahid\Lms\Providers;

use Juzaweb\CMS\Support\ServiceProvider;
use Juzaweb\CMS\Facades\ActionRegister;
use Mojahid\Lms\Actions\LmsAction;
use Mojahid\Lms\Actions\MenuAction;
use Mojahid\Lms\Http\Middleware\LmsTheme;
use Illuminate\Support\Facades\Route;
use TwigBridge\Facade\Twig;
use Mojahid\Lms\Extensions\TwigExtension;

class LmsServiceProvider extends ServiceProvider
{
    public function boot()
    {
        Route::pushMiddlewareToGroup('theme', LmsTheme::class);

        Twig::addExtension(new TwigExtension());

        ActionRegister::register([
            LmsAction::class,
            MenuAction::class
        ]);
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register(): void
    {
        $this->mergeConfigFrom(
            __DIR__.'/../../config/lms.php',
            'lms'
        );
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
