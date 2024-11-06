<?php

/**
 * JUZAWEB CMS - Laravel CMS for Your Project
 *
 * @package    mojar/juzacms
 * @author     The Anh Dang
 * @link       https://mojar.com
 * @license    GNU V2
 */

namespace Mojar\DevTool\Providers;

use Mojar\CMS\Support\ServiceProvider;
use Mojar\DevTool\Actions\MenuAction;

class UIServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        $this->registerHookActions([MenuAction::class]);
    }
}
