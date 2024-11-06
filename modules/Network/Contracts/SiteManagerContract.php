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

use Mojar\Network\Models\Site;

interface SiteManagerContract
{
    public function find(string|int|Site $site): ?NetworkSiteContract;

    public function create(string $subdomain, array $args = []): NetworkSiteContract;

    public function getCreater(): SiteCreaterContract;
}
