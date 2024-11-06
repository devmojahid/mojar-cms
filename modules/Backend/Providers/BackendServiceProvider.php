<?php

namespace Mojar\Backend\Providers;

use Illuminate\Foundation\AliasLoader;
use Illuminate\Routing\Router;
use Mojar\Backend\Actions\BackupAction;
use Mojar\Backend\Actions\EmailAction;
use Mojar\Backend\Actions\EnqueueStyleAction;
use Mojar\Backend\Actions\MediaAction;
use Mojar\Backend\Actions\MenuAction;
use Mojar\Backend\Actions\PermissionAction;
use Mojar\Backend\Actions\SeoAction;
use Mojar\Backend\Actions\SocialLoginAction;
use Mojar\Backend\Actions\ToolAction;
use Mojar\Backend\Commands\AutoSubmitCommand;
use Mojar\Backend\Commands\AutoTagCommand;
use Mojar\Backend\Commands\EmailTemplateGenerateCommand;
use Mojar\Backend\Commands\ImportTranslationCommand;
use Mojar\Backend\Commands\OptimizeTagCommand;
use Mojar\Backend\Commands\PermissionGenerateCommand;
use Mojar\Backend\Commands\PingFeedCommand;
use Mojar\Backend\Commands\Post\GeneratePostUUIDCommand;
use Mojar\Backend\Commands\Publish\CMSPublishCommand;
use Mojar\Backend\Commands\ThemePublishCommand;
use Mojar\Backend\Commands\TransFromEnglish;
use Mojar\Backend\Models\Comment;
use Mojar\Backend\Models\Menu;
use Mojar\Backend\Models\Post;
use Mojar\Backend\Models\Taxonomy;
use Mojar\Backend\Observers\CommentObserver;
use Mojar\Backend\Observers\MenuObserver;
use Mojar\Backend\Observers\PostObserver;
use Mojar\Backend\Observers\TaxonomyObserver;
use Mojar\Backend\Repositories\CommentRepository;
use Mojar\Backend\Repositories\CommentRepositoryEloquent;
use Mojar\Backend\Repositories\Email\EmailTemplateRepository;
use Mojar\Backend\Repositories\Email\EmailTemplateRepositoryEloquent;
use Mojar\Backend\Repositories\MediaFileRepository;
use Mojar\Backend\Repositories\MediaFileRepositoryEloquent;
use Mojar\Backend\Repositories\MediaFolderRepository;
use Mojar\Backend\Repositories\MediaFolderRepositoryEloquent;
use Mojar\Backend\Repositories\MenuRepository;
use Mojar\Backend\Repositories\MenuRepositoryEloquent;
use Mojar\Backend\Repositories\NotificationRepository;
use Mojar\Backend\Repositories\NotificationRepositoryEloquent;
use Mojar\Backend\Repositories\PostRepository;
use Mojar\Backend\Repositories\PostRepositoryEloquent;
use Mojar\Backend\Repositories\ResourceRepository;
use Mojar\Backend\Repositories\ResourceRepositoryEloquent;
use Mojar\Backend\Repositories\TaxonomyRepository;
use Mojar\Backend\Repositories\TaxonomyRepositoryEloquent;
use Mojar\Backend\Repositories\UserRepository;
use Mojar\Backend\Repositories\UserRepositoryEloquent;
use Mojar\CMS\Facades\ActionRegister;
use Mojar\CMS\Http\Middleware\Admin;
use Mojar\CMS\Facades\Field;
use Mojar\CMS\Support\Macros\RouterMacros;
use Mojar\CMS\Support\ServiceProvider;

class BackendServiceProvider extends ServiceProvider
{
    public array $bindings = [
        PostRepository::class => PostRepositoryEloquent::class,
        TaxonomyRepository::class => TaxonomyRepositoryEloquent::class,
        UserRepository::class => UserRepositoryEloquent::class,
        MediaFileRepository::class => MediaFileRepositoryEloquent::class,
        MediaFolderRepository::class => MediaFolderRepositoryEloquent::class,
        NotificationRepository::class => NotificationRepositoryEloquent::class,
        CommentRepository::class => CommentRepositoryEloquent::class,
        MenuRepository::class => MenuRepositoryEloquent::class,
        ResourceRepository::class => ResourceRepositoryEloquent::class,
        EmailTemplateRepository::class => EmailTemplateRepositoryEloquent::class,
    ];

    public function boot(): void
    {
        $this->bootMiddlewares();
        $this->bootPublishes();

        Taxonomy::observe(TaxonomyObserver::class);
        Post::observe(PostObserver::class);
        Menu::observe(MenuObserver::class);
        Comment::observe(CommentObserver::class);

        ActionRegister::register(
            [
                MenuAction::class,
                EnqueueStyleAction::class,
                PermissionAction::class,
                SocialLoginAction::class,
                ToolAction::class,
                SeoAction::class,
                BackupAction::class,
                MediaAction::class,
                EmailAction::class,
            ]
        );

        $this->commands(
            [
                PermissionGenerateCommand::class,
                ImportTranslationCommand::class,
                TransFromEnglish::class,
                EmailTemplateGenerateCommand::class,
                ThemePublishCommand::class,
                AutoSubmitCommand::class,
                AutoTagCommand::class,
                OptimizeTagCommand::class,
                PingFeedCommand::class,
                GeneratePostUUIDCommand::class,
                CMSPublishCommand::class,
            ]
        );
    }

    public function register(): void
    {
        $this->loadViewsFrom(__DIR__ . '/../resources/views', 'cms');
        $this->loadTranslationsFrom(__DIR__ . '/../resources/lang', 'cms');

        $this->app->register(RouteServiceProvider::class);
        $this->app->register(AuthServiceProvider::class);
        $this->registerRouteMacros();
        $this->app->booting(
            function () {
                $loader = AliasLoader::getInstance();
                $loader->alias('Field', Field::class);
            }
        );
    }

    protected function bootMiddlewares(): void
    {
        /**
         * @var Router $router
         */
        $router = $this->app['router'];
        $router->aliasMiddleware('admin', Admin::class);
    }

    protected function bootPublishes(): void
    {
        $this->publishes(
            [
                __DIR__ . '/../resources/views' => resource_path('views/vendor/cms'),
            ],
            'cms_views'
        );

        $this->publishes(
            [
                __DIR__ . '/../resources/lang' => resource_path('lang/cms'),
            ],
            'cms_lang'
        );

        $this->publishes(
            [
                __DIR__ . '/../resources/assets/public' => public_path('jw-styles/mojar'),
            ],
            'cms_assets'
        );
    }

    protected function registerRouteMacros(): void
    {
        Router::mixin(new RouterMacros());
    }
}
