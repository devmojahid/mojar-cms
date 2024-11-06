<?php

/**
 * JUZAWEB CMS - Laravel CMS for Your Project
 *
 * @package    mojar/cms
 * @author     The Anh Dang
 * @link       https://mojar.com/cms
 * @license    GNU V2
 */

namespace Mojar\Frontend\Providers;

use Illuminate\Foundation\Support\Providers\RouteServiceProvider as BaseServiceProvider;
use Illuminate\Support\Facades\Route;

class RouteServiceProvider extends BaseServiceProvider
{
    public function map(): void
    {
        $this->mapAssetRoutes();
        $this->mapThemeRoutes();
    }

    protected function mapAssetRoutes(): void
    {
        Route::group([], __DIR__ . '/../routes/assets.php');
    }

    protected function mapThemeRoutes(): void
    {
        Route::middleware('theme')
            ->prefix(config('theme.route_prefix'))
            ->group(__DIR__ . '/../routes/theme.php');
    }
}
