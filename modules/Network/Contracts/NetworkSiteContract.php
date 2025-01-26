<?php

/**
 * Mojar - The Best CMS for Laravel Project
 *
 * @package    mojar/cms
 * @author     Mojar Team <admin@mojar.com>
 * @link       https://mojar.com
 * @license    MIT
 */

namespace Juzaweb\Network\Contracts;

use Juzaweb\CMS\Models\User;

interface NetworkSiteContract
{
    public function getLoginUrl(User $user): string;
}
