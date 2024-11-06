<?php

namespace Mojar\DevTool\Providers;

use Illuminate\Support\ServiceProvider;
use Mojar\DevTool\Commands\CacheSizeCommand;
use Mojar\DevTool\Commands\FindFillableColumnCommand;
use Mojar\DevTool\Commands\MakeAdminCommand;
use Mojar\DevTool\Commands\Plugin;
use Mojar\DevTool\Commands\Plugin\ActionMakeCommand;
use Mojar\DevTool\Commands\Plugin\CommandMakeCommand;
use Mojar\DevTool\Commands\Plugin\ControllerMakeCommand;
use Mojar\DevTool\Commands\Plugin\DisableCommand;
use Mojar\DevTool\Commands\Plugin\EnableCommand;
use Mojar\DevTool\Commands\Plugin\EventMakeCommand;
use Mojar\DevTool\Commands\Plugin\InstallCommand as PluginInstallCommand;
use Mojar\DevTool\Commands\Plugin\JobMakeCommand;
use Mojar\DevTool\Commands\Plugin\ListCommand;
use Mojar\DevTool\Commands\Plugin\ListenerMakeCommand;
use Mojar\DevTool\Commands\Plugin\MiddlewareMakeCommand;
use Mojar\DevTool\Commands\Plugin\ModelMakeCommand;
use Mojar\DevTool\Commands\Plugin\ModuleDeleteCommand;
use Mojar\DevTool\Commands\Plugin\ModuleMakeCommand;
use Mojar\DevTool\Commands\Plugin\ProviderMakeCommand;
use Mojar\DevTool\Commands\Plugin\Publish\PublishCommand;
use Mojar\DevTool\Commands\Plugin\RequestMakeCommand;
use Mojar\DevTool\Commands\Plugin\ResourceMakeCommand;
use Mojar\DevTool\Commands\Plugin\RouteProviderMakeCommand;
use Mojar\DevTool\Commands\Plugin\RuleMakeCommand;
use Mojar\DevTool\Commands\Plugin\SeedCommand;
use Mojar\DevTool\Commands\Resource;
use Mojar\DevTool\Commands\Theme;

class ConsoleServiceProvider extends ServiceProvider
{
    protected array $commands = [
        PluginInstallCommand::class,
        CommandMakeCommand::class,
        ControllerMakeCommand::class,
        DisableCommand::class,
        //DumpCommand::class,
        EnableCommand::class,
        EventMakeCommand::class,
        JobMakeCommand::class,
        ListenerMakeCommand::class,
        PublishCommand::class,
        //MailMakeCommand::class,
        MiddlewareMakeCommand::class,
        //NotificationMakeCommand::class,
        ProviderMakeCommand::class,
        RouteProviderMakeCommand::class,
        ListCommand::class,
        ModuleDeleteCommand::class,
        ModuleMakeCommand::class,
        //FactoryMakeCommand::class,
        //PolicyMakeCommand::class,
        RequestMakeCommand::class,
        RuleMakeCommand::class,
        Plugin\Migration\MigrateCommand::class,
        Plugin\Migration\MigrateRefreshCommand::class,
        Plugin\Migration\MigrateResetCommand::class,
        Plugin\Migration\MigrateRollbackCommand::class,
        Plugin\Migration\MigrateStatusCommand::class,
        Plugin\Migration\MigrationMakeCommand::class,
        ModelMakeCommand::class,
        SeedCommand::class,
        Plugin\SeedMakeCommand::class,
        ResourceMakeCommand::class,
        Plugin\TestMakeCommand::class,
        Theme\ThemeGeneratorCommand::class,
        Theme\ThemeListCommand::class,
        ActionMakeCommand::class,
        Plugin\DatatableMakeCommand::class,
        Resource\MojarResouceMakeCommand::class,
        MakeAdminCommand::class,
        Theme\GenerateDataThemeCommand::class,
        Theme\DownloadStyleCommand::class,
        Theme\DownloadTemplateCommand::class,
        Plugin\UpdateCommand::class,
        Theme\ThemeUpdateCommand::class,
        Theme\MakeBlockCommand::class,
        CacheSizeCommand::class,
        Plugin\Translation\ImportTranslationCommand::class,
        Plugin\Translation\TranslateViaGoogleCommand::class,
        Plugin\Translation\ExportTranslationCommand::class,
        Plugin\RepositoryMakeCommand::class,
        Theme\ExportTranslationCommand::class,
        Theme\ImportTranslationCommand::class,
        Theme\TranslateViaGoogleCommand::class,
        FindFillableColumnCommand::class,
        Resource\CRUDMakeCommand::class,
    ];

    /**
     * Register the commands.
     */
    public function register(): void
    {
        $this->commands($this->commands);

        // Register UI & router dev-tools
        if (is_dev_tool_enable()) {
            $this->app->register(UIServiceProvider::class);
            $this->app->register(RouteServiceProvider::class);
        }
    }

    /**
     * @return array
     */
    public function provides(): array
    {
        return $this->commands;
    }
}
