<?php

namespace Mojar\Multilang\Providers;

use Illuminate\Routing\Router;
use Mojar\Multilang\Http\Middleware\Multilang;
use Mojar\CMS\Support\ServiceProvider;
use Mojar\Multilang\MultilangAction;

class MultilangServiceProvider extends ServiceProvider
{
    public function boot()
    {
        /** @var Router $router */
        $router = $this->app['router'];
        $router->pushMiddlewareToGroup('theme', Multilang::class);

        $this->registerHookActions([MultilangAction::class]);

        $this->loadViewsFrom(__DIR__ . '/../resources/views', 'mlla');
    }
}
