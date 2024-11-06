<?php

/**
 * JUZAWEB CMS - Laravel CMS for Your Project
 *
 * @package    mojar/cms
 * @author     The Anh Dang
 * @link       https://mojar.com/cms
 * @license    GNU V2
 */

namespace Mojar\CMS\Traits;

//use Rennokki\QueryCache\Traits\QueryCacheable;

trait ModelCache
{
    //use QueryCacheable;

    protected static $flushCacheOnUpdate = true;
}
