<?php

namespace Mojar\CMS\Providers;

use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\ServiceProvider;
use Illuminate\Validation\Rule;
use Mojar\API\Providers\APIServiceProvider;
use Mojar\Backend\Providers\BackendServiceProvider;
use Mojar\Backend\Repositories\PostRepository;
use Mojar\Backend\Repositories\TaxonomyRepository;
use Mojar\CMS\Contracts\ActionRegisterContract;
use Mojar\CMS\Contracts\BackendMessageContract;
use Mojar\CMS\Contracts\CacheGroupContract;
use Mojar\CMS\Contracts\ConfigContract;
use Mojar\CMS\Contracts\EventyContract;
use Mojar\CMS\Contracts\Field;
use Mojar\CMS\Contracts\GlobalDataContract;
use Mojar\CMS\Contracts\GoogleTranslate as GoogleTranslateContract;
use Mojar\CMS\Contracts\HookActionContract;
use Mojar\CMS\Contracts\MojarApiContract;
use Mojar\CMS\Contracts\JWQueryContract;
use Mojar\CMS\Contracts\LocalPluginRepositoryContract;
use Mojar\CMS\Contracts\LocalThemeRepositoryContract;
use Mojar\CMS\Contracts\MacroableModelContract;
use Mojar\CMS\Contracts\Media\Media as MediaContract;
use Mojar\CMS\Contracts\OverwriteConfigContract;
use Mojar\CMS\Contracts\PostImporterContract;
use Mojar\CMS\Contracts\PostManagerContract;
use Mojar\CMS\Contracts\ShortCode as ShortCodeContract;
use Mojar\CMS\Contracts\ShortCodeCompiler as ShortCodeCompilerContract;
use Mojar\CMS\Contracts\StorageDataContract;
use Mojar\CMS\Contracts\TableGroupContract;
use Mojar\CMS\Contracts\ThemeConfigContract;
use Mojar\CMS\Contracts\TranslationFinder as TranslationFinderContract;
use Mojar\CMS\Contracts\TranslationManager as TranslationManagerContract;
use Mojar\CMS\Contracts\XssCleanerContract;
use Mojar\CMS\Extension\Custom;
use Mojar\CMS\Facades\OverwriteConfig;
use Mojar\CMS\Support\ActionRegister;
use Mojar\CMS\Support\CacheGroup;
use Mojar\CMS\Support\Config as DbConfig;
use Mojar\CMS\Support\DatabaseTableGroup;
use Mojar\CMS\Support\GlobalData;
use Mojar\CMS\Support\GoogleTranslate;
use Mojar\CMS\Support\HookAction;
use Mojar\CMS\Support\Html\Field as HtmlField;
use Mojar\CMS\Support\Imports\PostImporter;
use Mojar\CMS\Support\MojarApi;
use Mojar\CMS\Support\JWQuery;
use Mojar\CMS\Support\MacroableModel;
use Mojar\CMS\Support\Manager\BackendMessageManager;
use Mojar\CMS\Support\Manager\PostManager;
use Mojar\CMS\Support\Manager\TranslationManager;
use Mojar\CMS\Support\Media\Media;
use Mojar\CMS\Support\ShortCode\Compilers\ShortCodeCompiler;
use Mojar\CMS\Support\ShortCode\ShortCode;
use Mojar\CMS\Support\StorageData;
use Mojar\CMS\Support\Theme\ThemeConfig;
use Mojar\CMS\Support\Translations\TranslationFinder;
use Mojar\CMS\Support\Validators\ModelExists;
use Mojar\CMS\Support\Validators\ModelUnique;
use Mojar\CMS\Support\XssCleaner;
use Mojar\DevTool\Providers\DevToolServiceProvider;
use Mojar\Frontend\Providers\FrontendServiceProvider;
use Mojar\Multilang\Providers\MultilangServiceProvider;
use Mojar\Network\Providers\NetworkServiceProvider;
use Mojar\Translation\Providers\TranslationServiceProvider;
use Laravel\Passport\Passport;
use TwigBridge\Facade\Twig;

class CmsServiceProvider extends ServiceProvider
{
    protected string $basePath = __DIR__ . '/..';

    public function boot()
    {
        $this->bootMigrations();
        $this->bootPublishes();
        $this->configureRateLimiting();

        Validator::extend(
            'recaptcha',
            '\Mojar\CMS\Support\Validators\ReCaptchaValidator@validate'
        );

        Validator::extend(
            'domain',
            '\Mojar\CMS\Support\Validators\DomainValidator@validate'
        );

        Rule::macro(
            'modelExists',
            function (
                string $modelClass,
                string $modelAttribute = 'id',
                callable $callback = null
            ) {
                return new ModelExists($modelClass, $modelAttribute, $callback);
            }
        );

        Rule::macro(
            'modelUnique',
            function (
                string $modelClass,
                string $modelAttribute = 'id',
                callable $callback = null
            ) {
                return new ModelUnique($modelClass, $modelAttribute, $callback);
            }
        );

        // Prevent lazy loading in local environment
        //Model::preventLazyLoading(!$this->app->isProduction());

        Schema::defaultStringLength(150);

        Twig::addExtension(new Custom());

        Paginator::useBootstrapFive();

        OverwriteConfig::init();

        /*$this->app->booted(function () {
            $schedule = $this->app->make(Schedule::class);
            $schedule->command('juzacms:update')->everyMinute();
        });*/
    }

    public function register(): void
    {
        $this->registerSingleton();
        $this->registerConfigs();
        $this->registerProviders();
        Passport::ignoreMigrations();
    }

    protected function registerConfigs()
    {
        $this->mergeConfigFrom(
            $this->basePath . '/config/mojar.php',
            'mojar'
        );

        $this->mergeConfigFrom(
            $this->basePath . '/config/locales.php',
            'locales'
        );

        $this->mergeConfigFrom(
            $this->basePath . '/config/countries.php',
            'countries'
        );

        $this->mergeConfigFrom(
            $this->basePath . '/config/installer.php',
            'installer'
        );

        $this->mergeConfigFrom(
            $this->basePath . '/config/network.php',
            'network'
        );
    }

    protected function bootMigrations()
    {
        $mainPath = $this->basePath . '/Database/migrations';
        $directories = glob($mainPath . '/*', GLOB_ONLYDIR);
        $paths = array_merge([$mainPath], $directories);
        $this->loadMigrationsFrom($paths);
    }

    protected function bootPublishes()
    {
        $this->publishes(
            [
                $this->basePath . '/config/mojar.php' => base_path('config/mojar.php'),
                $this->basePath . '/config/network.php' => base_path('config/network.php'),
            ],
            'cms_config'
        );
    }

    protected function registerSingleton()
    {
        $this->app->singleton(
            MacroableModelContract::class,
            function () {
                return new MacroableModel();
            }
        );

        $this->app->singleton(
            ActionRegisterContract::class,
            function ($app) {
                return new ActionRegister($app);
            }
        );

        $this->app->singleton(
            ConfigContract::class,
            function ($app) {
                return new DbConfig($app, $app['cache']);
            }
        );

        $this->app->singleton(
            ThemeConfigContract::class,
            function ($app) {
                return new ThemeConfig($app, jw_current_theme());
            }
        );

        $this->app->singleton(
            HookActionContract::class,
            function ($app) {
                return new HookAction(
                    $app[EventyContract::class],
                    $app[GlobalDataContract::class]
                );
            }
        );

        $this->app->singleton(
            GlobalDataContract::class,
            function () {
                return new GlobalData();
            }
        );

        $this->app->singleton(
            XssCleanerContract::class,
            function () {
                return new XssCleaner();
            }
        );

        $this->app->singleton(
            CacheGroupContract::class,
            function ($app) {
                return new CacheGroup($app['cache']);
            }
        );

        $this->app->singleton(
            OverwriteConfigContract::class,
            function ($app) {
                return new DbConfig\OverwriteConfig(
                    $app['config'],
                    $app[ConfigContract::class],
                    $app['request'],
                    $app['translator']
                );
            }
        );

        $this->app->singleton(
            StorageDataContract::class,
            function () {
                return new StorageData();
            }
        );

        $this->app->singleton(
            TableGroupContract::class,
            function ($app) {
                return new DatabaseTableGroup(
                    $app['migrator']
                );
            }
        );

        $this->app->singleton(
            BackendMessageContract::class,
            function ($app) {
                return new BackendMessageManager(
                    $app[ConfigContract::class]
                );
            }
        );

        $this->app->singleton(
            MojarApiContract::class,
            function ($app) {
                return new MojarApi(
                    $app[ConfigContract::class]
                );
            }
        );

        $this->app->singleton(
            JWQueryContract::class,
            function ($app) {
                return new JWQuery($app['db']);
            }
        );

        $this->app->singleton(
            PostManagerContract::class,
            function ($app) {
                return new PostManager(
                    $app[PostRepository::class]
                );
            }
        );

        $this->app->singleton(
            PostImporterContract::class,
            function ($app) {
                return new PostImporter(
                    $app[PostManagerContract::class],
                    $app[HookActionContract::class],
                    $app[TaxonomyRepository::class]
                );
            }
        );

        $this->app->singleton(
            Field::class,
            function ($app) {
                return new HtmlField();
            }
        );

        $this->app->singleton(
            ShortCodeCompilerContract::class,
            function ($app) {
                return new ShortCodeCompiler();
            }
        );

        $this->app->singleton(
            ShortCodeContract::class,
            function ($app) {
                return new ShortCode($app[ShortCodeCompilerContract::class]);
            }
        );

        $this->app->singleton(MediaContract::class, Media::class);

        $this->app->singleton(
            TranslationFinderContract::class,
            function ($app) {
                return new TranslationFinder();
            }
        );

        $this->app->singleton(
            TranslationManagerContract::class,
            function ($app) {
                return new TranslationManager(
                    $app[LocalPluginRepositoryContract::class],
                    $app[LocalThemeRepositoryContract::class],
                    $app[TranslationFinderContract::class],
                    $app[GoogleTranslateContract::class]
                );
            }
        );

        $this->app->bind(
            GoogleTranslateContract::class,
            fn($app) => new GoogleTranslate($app[\Illuminate\Contracts\Filesystem\Factory::class])
        );
    }

    protected function registerProviders()
    {
        $this->app->register(RepositoryServiceProvider::class);
        if (config('network.enable')) {
            $this->app->register(NetworkServiceProvider::class);
        }

        $this->app->register(HookActionServiceProvider::class);
        $this->app->register(PermissionServiceProvider::class);
        $this->app->register(PerformanceServiceProvider::class);
        $this->app->register(EventServiceProvider::class);
        $this->app->register(PluginServiceProvider::class);
        $this->app->register(ConsoleServiceProvider::class);
        $this->app->register(NotificationServiceProvider::class);
        $this->app->register(DevToolServiceProvider::class);
        $this->app->register(ThemeServiceProvider::class);
        //$this->app->register(MultilangServiceProvider::class);
        $this->app->register(BackendServiceProvider::class);
        $this->app->register(FrontendServiceProvider::class);
        $this->app->register(ShortCodeServiceProvider::class);

        if (config('mojar.translation.enable')) {
            $this->app->register(TranslationServiceProvider::class);
        }

        if (config('mojar.api.enable')) {
            $this->app->register(APIServiceProvider::class);
        }
    }

    protected function configureRateLimiting(): void
    {
        RateLimiter::for(
            'api',
            function (Request $request) {
                return Limit::perMinute(120)
                    ->by($request->user()?->id ?: get_client_ip());
            }
        );
    }
}
