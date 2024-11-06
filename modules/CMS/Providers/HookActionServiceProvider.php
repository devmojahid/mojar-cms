<?php

/**
 * @package    mojar/cms
 * @author     The Anh Dang
 * @link       https://github.com/mojar/cms
 * @license    GNU V2
 */

namespace Mojar\CMS\Providers;

use Illuminate\Support\Facades\Blade;
use Mojar\CMS\Support\ServiceProvider;
use Mojar\CMS\Contracts\EventyContract;
use Mojar\CMS\Support\Hooks\Events;

class HookActionServiceProvider extends ServiceProvider
{
    public function boot()
    {
        /*
         * Adds a directive in Blade for actions
         */
        Blade::directive(
            'do_action',
            function ($expression) {
                return "<?php app(\Mojar\CMS\Contracts\EventyContract::class)->action({$expression}); ?>";
            }
        );

        /*
         * Adds a directive in Blade for filters
         */
        Blade::directive(
            'apply_filters',
            function ($expression) {
                return "<?php echo app(\Mojar\CMS\Contracts\EventyContract::class)->filter({$expression}); ?>";
            }
        );
    }

    public function register()
    {
        // Registers the eventy singleton.
        $this->app->singleton(
            EventyContract::class,
            function () {
                return new Events();
            }
        );
    }
}
