<?php

/**
 * JUZAWEB CMS - The Best CMS for Laravel Project
 *
 * @package    mojar/cms
 * @author     Mojar Team <admin@mojar.com>
 * @link       https://mojar.com
 * @license    MIT
 */

namespace Juzaweb\API\Providers;

use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;

class RouteServiceProvider extends ServiceProvider
{
    public function map()
    {
        $this->mapAdminRoutes();
        $this->mapApiRoutes();
    }

    protected function mapApiRoutes(): void
    {
        Route::prefix('api')
            ->middleware('api')
            ->as('api.')
            ->group(__DIR__ . '/../routes/api.php');
    }

    protected function mapAdminRoutes(): void
    {
        Route::prefix(config('mojar.admin_prefix'))
            ->middleware('admin')
            ->group(__DIR__ . '/../routes/admin.php');
    }
}
