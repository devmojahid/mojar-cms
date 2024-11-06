<?php

namespace Mojar\CMS\Facades;

use Illuminate\Support\Facades\Facade;
use Mojar\CMS\Contracts\CacheGroupContract;

/**
 * @method static void add(string $group, string $key, int|null $ttl = null)
 * @method static array get(string $group)
 * @method static self driver(?string $driver)
 * @method static void pull(string $group)
 * @see \Mojar\CMS\Support\CacheGroup
 */
class CacheGroup extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return CacheGroupContract::class;
    }
}
