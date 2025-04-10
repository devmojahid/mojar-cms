<?php

/**
 * Mojar - The Best CMS for Laravel Project
 *
 * @package    mojar/cms
 * @author     Mojar Team <admin@mojar.com>
 * @link       https://mojar.com
 * @license    MIT
 */

namespace Juzaweb\API\Providers;

use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Juzaweb\API\Actions\APIAction;
use Juzaweb\CMS\Facades\ActionRegister;
use Juzaweb\CMS\Support\ServiceProvider;

class APIServiceProvider extends ServiceProvider
{
    public function boot()
    {
        ActionRegister::register(
            [
                APIAction::class,
            ]
        );
    }

    public function register()
    {
        $this->loadViewsFrom(__DIR__ . '/../resources/views', 'api');

        $this->app->register(RouteServiceProvider::class);
    }
}
