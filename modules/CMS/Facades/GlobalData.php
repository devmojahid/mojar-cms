<?php

/**
 * Mojar - Laravel CMS for Your Project
 *
 * @package    mojar/cms
 * @author     The Anh Dang
 * @link       https://mojar.com/cms
 * @license    GNU V2
 */

namespace Juzaweb\CMS\Facades;

use Illuminate\Support\Facades\Facade;
use Juzaweb\CMS\Contracts\GlobalDataContract;

/**
 * @method static void set($key, $value)
 * @method static void push($key, $value)
 * @method static void registerAction(array $actions)
 * @method static void initAction()
 * @method static mixed get($key)
 * @see \Juzaweb\CMS\Support\GlobalData
 */
class GlobalData extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return GlobalDataContract::class;
    }
}
