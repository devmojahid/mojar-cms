<?php

/**
 * Mojar - The Best CMS for Laravel Project
 *
 * @package    mojar/cms
 * @author     Mojar Team <admin@mojar.com>
 * @link       https://mojar.com
 * @license    MIT
 */

namespace Juzaweb\Network\Facades;

use Illuminate\Support\Facades\Facade;
use Juzaweb\Network\Contracts\NetworkRegistionContract;

/**
 * @method static void init()
 * @method static bool isRootSite($domain = null)
 * @method static string getCurrentDomain()
 * @method static object getCurrentSite()
 * @method static null|int getCurrentSiteId()
 * @see \Juzaweb\Network\Support\NetworkRegistion
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
