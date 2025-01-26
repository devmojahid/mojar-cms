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

use Juzaweb\Network\Models\Site;

interface SiteManagerContract
{
    public function find(string|int|Site $site): ?NetworkSiteContract;

    public function create(string $subdomain, array $args = []): NetworkSiteContract;

    public function getCreater(): SiteCreaterContract;
}
