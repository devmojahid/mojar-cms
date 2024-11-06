<?php

namespace Mojar\CMS\Facades;

use Illuminate\Support\Facades\Facade;
use Mojar\CMS\Contracts\OverwriteConfigContract;

/**
 * @method static void init()
 *
 * @see \Mojar\CMS\Support\Config\OverwriteConfig
 */
class OverwriteConfig extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return OverwriteConfigContract::class;
    }
}
