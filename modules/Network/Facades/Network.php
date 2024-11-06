<?php

/**
 * JUZAWEB CMS - The Best CMS for Laravel Project
 *
 * @package    mojar/cms
 * @author     Mojar Team <admin@mojar.com>
 * @link       https://mojar.com
 * @license    MIT
 */

namespace Mojar\Network\Facades;

use Illuminate\Support\Facades\Facade;
use Mojar\Network\Contracts\NetworkRegistionContract;

/**
 * @method static void init()
 * @method static bool isRootSite($domain = null)
 * @method static string getCurrentDomain()
 * @method static object getCurrentSite()
 * @method static null|int getCurrentSiteId()
 * @see \Mojar\Network\Support\NetworkRegistion
 */
class Network extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor(): string
    {
        return NetworkRegistionContract::class;
    }
}
