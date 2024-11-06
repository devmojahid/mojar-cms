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
use Mojar\CMS\Contracts\XssCleanerContract;

/**
 * @method static string clean(string $value)
 *
 * @see \Mojar\CMS\Support\XssCleaner
 */
class XssCleaner extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     * @throws \RuntimeException
     */
    protected static function getFacadeAccessor()
    {
        return XssCleanerContract::class;
    }
}
