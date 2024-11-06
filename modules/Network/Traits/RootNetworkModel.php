<?php

/**
 * JUZAWEB CMS - The Best CMS for Laravel Project
 *
 * @package    mojar/cms
 * @author     Mojar Team <admin@mojar.com>
 * @link       https://mojar.com
 * @license    MIT
 */

namespace Mojar\Network\Traits;

use Mojar\Network\Facades\Network;

trait RootNetworkModel
{
    public function getConnectionName()
    {
        if (config('network.enable') && !Network::isRootSite()) {
            return Network::getCurrentSite()->root_connection;
        }

        return $this->connection;
    }
}
