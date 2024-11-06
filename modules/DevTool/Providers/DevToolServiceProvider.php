<?php

/**
 * JUZAWEB CMS - Laravel CMS for Your Project
 *
 * @package    mojar/cms
 * @author     The Anh Dang
 * @link       https://mojar.com/cms
 * @license    GNU V2
 */

namespace Mojar\DevTool\Providers;

use Illuminate\Database\Query\Builder;
use Illuminate\Database\Eloquent\Builder as EloquentBuilder;
use Mojar\CMS\Providers\TelescopeServiceProvider;
use Mojar\CMS\Support\ServiceProvider;
use Mojar\CMS\Support\Stub;
use Laravel\Telescope\TelescopeApplicationServiceProvider;

class DevToolServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        if ($this->app->environment('local')) {
            if (config('app.debug')) {
                if (
                    class_exists(TelescopeApplicationServiceProvider::class)
                    && class_exists(TelescopeServiceProvider::class)
                ) {
                    $this->app->register(TelescopeServiceProvider::class);
                }
            }

            Builder::macro(
                'toRawSql',
                function () {
                    /** @var Builder $this */
                    return array_reduce(
                        $this->getBindings(),
                        static function ($sql, $binding) {
                            return preg_replace(
                                '/\?/',
                                is_numeric($binding) ? $binding : "'" . $binding . "'",
                                $sql,
                                1
                            );
                        },
                        $this->toSql()
                    );
                }
            );

            EloquentBuilder::macro(
                'toRawSql',
                function () {
                    /** @var EloquentBuilder $this */
                    return array_reduce(
                        $this->getBindings(),
                        static function ($sql, $binding) {
                            return preg_replace(
                                '/\?/',
                                is_numeric($binding) ? $binding : "'" . $binding . "'",
                                $sql,
                                1
                            );
                        },
                        $this->toSql()
                    );
                }
            );

            Builder::macro(
                'ddRawSql',
                function () {
                    /** @var Builder $this */
                    dd($this->toRawSql());
                }
            );

            EloquentBuilder::macro(
                'ddRawSql',
                function () {
                    /** @var EloquentBuilder $this */
                    dd($this->toRawSql());
                }
            );
        }
    }

    public function register(): void
    {
        $this->setupStubPath();

        $this->app->register(ConsoleServiceProvider::class);

        $this->mergeConfigFrom(__DIR__ . '/../../CMS/config/dev-tool.php', 'dev-tool');
    }

    /**
     * Setup stub path.
     */
    public function setupStubPath(): void
    {
        Stub::setBasePath(__DIR__ . '/../stubs/plugin');
    }
}
