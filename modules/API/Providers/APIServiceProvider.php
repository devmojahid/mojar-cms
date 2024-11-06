<?php

/**
 * JUZAWEB CMS - The Best CMS for Laravel Project
 *
 * @package    mojar/cms
 * @author     Mojar Team <admin@mojar.com>
 * @link       https://mojar.com
 * @license    MIT
 */

namespace Mojar\API\Providers;

use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Mojar\API\Actions\APIAction;
use Mojar\CMS\Facades\ActionRegister;
use Mojar\CMS\Support\ServiceProvider;

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
