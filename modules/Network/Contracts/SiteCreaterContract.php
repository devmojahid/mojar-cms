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

interface SiteCreaterContract
{
    public function create(string $subdomain, array $args = []): Site;

    public function setupSite(Site $site);
}
