<?php

/**
 * JUZAWEB CMS - Laravel CMS for Your Project
 *
 * @package    mojar/cms
 * @author     The Anh Dang
 * @link       https://mojar.com/cms
 * @license    GNU V2
 */

namespace Mojar\CMS\Facades;

use Illuminate\Support\Facades\Facade;
use Mojar\CMS\Contracts\ThemeConfigContract;

/**
 * @method static mixed setConfig($key, $value)
 * @method static string|array getConfig($key, $default)
 *
 * @see \Mojar\CMS\Support\Theme\ThemeConfig
 */
class ThemeConfig extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor(): string
    {
        return ThemeConfigContract::class;
    }
}
