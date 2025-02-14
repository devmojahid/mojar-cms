<?php 

namespace Mojahid\Ecommerce\Addons\PosAddon;

use Juzaweb\CMS\Abstracts\Action;
use Juzaweb\CMS\Facades\HookAction;
use Juzaweb\CMS\Support\ServiceProvider;
use Juzaweb\CMS\Facades\ActionRegister;
use Mojahid\Ecommerce\Addons\PosAddon\Actions\PosAction;

class PosAddonServiceProvider extends ServiceProvider
{
    public function boot()
    {
        // typical hooking points
        ActionRegister::register([
            PosAction::class,
        ]);
    }
}
