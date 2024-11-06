<?php

/**
 * JUZAWEB CMS - Laravel CMS for Your Project
 *
 * @package    mojar/cms
 * @author     The Anh Dang
 * @link       https://mojar.com/cms
 * @license    GNU V2
 */

namespace Mojar\CMS\Providers;

use Illuminate\Support\Facades\Lang;
use Mojar\CMS\Contracts\Theme\ThemeRender as ThemeRenderContract;
use Mojar\CMS\Contracts\ThemeLoaderContract;
use Mojar\CMS\Contracts\LocalThemeRepositoryContract;
use Mojar\CMS\Facades\ActionRegister;
use Mojar\CMS\Facades\ThemeLoader;
use Mojar\CMS\Support\ServiceProvider;
use Mojar\CMS\Support\Theme\Theme;
use Mojar\CMS\Support\LocalThemeRepository;
use Mojar\CMS\Support\Theme\ThemeRender;
use Mojar\Frontend\Actions\FrontendAction;
use Mojar\Frontend\Actions\ThemeAction;

class ThemeServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        if (config('mojar.frontend.enable')) {
            $this->registerTheme();
        }
    }

    public function register(): void
    {
        $this->app->singleton(
            ThemeLoaderContract::class,
            function ($app) {
                return new Theme($app, $app['view']->getFinder(), $app['config'], $app['translator']);
            }
        );

        $this->app->singleton(
            LocalThemeRepositoryContract::class,
            function ($app) {
                $path = config('mojar.theme.path');
                return new LocalThemeRepository($app, $path);
            }
        );

        $this->app->bind(ThemeRenderContract::class, ThemeRender::class);

        $this->app->alias(LocalThemeRepositoryContract::class, 'themes');
    }

    protected function registerTheme(): void
    {
        Lang::addJsonPath(ThemeLoader::getPath(jw_current_theme(), 'lang'));

        ActionRegister::register(
            [
                ThemeAction::class,
                FrontendAction::class,
            ]
        );
    }
}
