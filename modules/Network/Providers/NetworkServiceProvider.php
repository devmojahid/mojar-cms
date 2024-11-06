<?php

/**
 * JUZAWEB CMS - The Best CMS for Laravel Project
 *
 * @package    mojar/cms
 * @author     Mojar Team <admin@mojar.com>
 * @link       https://mojar.com
 * @license    MIT
 */

namespace Mojar\Network\Providers;

use Illuminate\Contracts\Console\Kernel;
use Mojar\CMS\Facades\ActionRegister;
use Mojar\CMS\Support\ServiceProvider;
use Mojar\Network\Commands\ArtisanCommand;
use Mojar\Network\Commands\MakeSiteCommand;
use Mojar\Network\Contracts\NetworkRegistionContract;
use Mojar\Network\Contracts\SiteCreaterContract;
use Mojar\Network\Contracts\SiteManagerContract;
use Mojar\Network\Contracts\SiteSetupContract;
use Mojar\Network\Facades\Network;
use Mojar\Network\Models\Site;
use Mojar\Network\NetworkAction;
use Mojar\Network\Observers\SiteModelObserver;
use Mojar\Network\Support\NetworkRegistion;
use Mojar\Network\Support\SiteCreater;
use Mojar\Network\Support\SiteManager;
use Mojar\Network\Support\SiteSetup;

class NetworkServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        Network::init();

        $this->commands([MakeSiteCommand::class, ArtisanCommand::class]);

        Site::observe([SiteModelObserver::class]);

        ActionRegister::register(NetworkAction::class);
    }

    public function register(): void
    {
        $this->app->register(RouteServiceProvider::class);

        $this->loadMigrationsFrom(__DIR__ . '/../Database/migrations');

        $this->loadViewsFrom(__DIR__ . '/../resources/views', 'network');

        $this->app->singleton(
            SiteSetupContract::class,
            function ($app) {
                return new SiteSetup(
                    $app['config'],
                    $app['db']
                );
            }
        );

        $this->app->singleton(
            SiteCreaterContract::class,
            function ($app) {
                return new SiteCreater(
                    $app['db'],
                    $app['config'],
                    $app[SiteSetupContract::class]
                );
            }
        );

        $this->app->singleton(
            NetworkRegistionContract::class,
            function ($app) {
                return new NetworkRegistion(
                    $app,
                    $app['config'],
                    $app['request'],
                    $app['cache'],
                    $app['db'],
                    $app[SiteSetupContract::class],
                    $app[Kernel::class]
                );
            }
        );

        $this->app->singleton(
            SiteManagerContract::class,
            function ($app) {
                return new SiteManager(
                    $app['db'],
                    $app[SiteCreaterContract::class]
                );
            }
        );
    }
}
