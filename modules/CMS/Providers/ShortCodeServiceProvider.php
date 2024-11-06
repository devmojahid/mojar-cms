<?php

/**
 * JUZAWEB CMS - The Best CMS for Laravel Project
 *
 * @package    mojar/cms
 * @author     Mojar Team <admin@mojar.com>
 * @link       https://mojar.com
 * @license    MIT
 */

namespace Mojar\CMS\Providers;

use Mojar\CMS\Facades\ShortCode;
use Mojar\CMS\Support\ServiceProvider;

class ShortCodeServiceProvider extends ServiceProvider
{
    public function register()
    {
        //ShortCode::register('b', BoldShortcode::class);
    }
}
