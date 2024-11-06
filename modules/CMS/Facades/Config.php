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

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Facade;
use Mojar\CMS\Contracts\ConfigContract;

/**
 * @method static \Mojar\CMS\Models\Config setConfig($key, $value)
 * @method static string|array getConfig($key, $default = null)
 * @method static Collection all()
 * @see \Mojar\CMS\Support\Config
 */
class Config extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor(): string
    {
        return ConfigContract::class;
    }
}
