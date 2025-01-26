<?php

/**
 * Mojar - The Best CMS for Laravel Project
 *
 * @package    mojar/cms
 * @author     Mojar Team <admin@mojar.com>
 * @link       https://mojar.com
 * @license    MIT
 */

namespace Juzaweb\Network\Providers;

use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Route;

class RouteServiceProvider extends ServiceProvider
{
    public function map()
    {
        $this->mapWebRoutes();
        $this->mapMasterAdminRoutes();
    }

    protected function mapMasterAdminRoutes()
    {
        Route::middleware('master_admin')
            ->prefix(config('mojar.admin_prefix') . '/network')
            ->group(__DIR__ . '/../routes/master_admin.php');
    }

    protected function mapWebRoutes()
    {
        Route::middleware('web')
            ->group(__DIR__ . '/../routes/web.php');
    }
}
