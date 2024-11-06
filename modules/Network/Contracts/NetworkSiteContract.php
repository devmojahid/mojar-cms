<?php

/**
 * JUZAWEB CMS - The Best CMS for Laravel Project
 *
 * @package    mojar/cms
 * @author     Mojar Team <admin@mojar.com>
 * @link       https://mojar.com
 * @license    MIT
 */

namespace Mojar\Network\Contracts;

use Mojar\CMS\Models\User;

interface NetworkSiteContract
{
    public function getLoginUrl(User $user): string;
}
