<?php

/**
 * JUZAWEB CMS - Laravel CMS for Your Project
 *
 * @package    mojar/cms
 * @author     The Anh Dang
 * @link       https://github.com/mojar/cms
 * @license    GNU V2
 */

namespace Mojar\CMS\Providers;

use Illuminate\Support\ServiceProvider;
use Mojar\CMS\Support\BladeMinifyCompiler;

class PerformanceServiceProvider extends ServiceProvider
{
    public function boot()
    {
        //
    }

    public function register()
    {
        if (config('mojar.performance.minify_views')) {
            $this->registerBladeCompiler();
        }
    }

    protected function registerBladeCompiler()
    {
        $this->app->singleton(
            'blade.compiler',
            function ($app) {
                return new BladeMinifyCompiler($app['files'], $app['config']['view.compiled']);
            }
        );
    }
}
