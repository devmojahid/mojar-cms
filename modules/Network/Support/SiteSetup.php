<?php

/**
 * Mojar - The Best CMS for Laravel Project
 *
 * @package    mojar/cms
 * @author     Mojar Team <admin@mojar.com>
 * @link       https://mojar.com
 * @license    MIT
 */

namespace Juzaweb\Network\Support;

use Illuminate\Contracts\Config\Repository as ConfigRepository;
use Illuminate\Database\ConnectionResolverInterface;
use Illuminate\Support\Facades\URL;
use Juzaweb\Network\Contracts\SiteSetupContract;

class SiteSetup implements SiteSetupContract
{
    protected ConfigRepository $config;

    protected ConnectionResolverInterface $db;

    public function __construct(
        ConfigRepository $config,
        ConnectionResolverInterface $db
    ) {
        $this->config = $config;

        $this->db = $db;
    }

    public function setup(object $site): object
    {
        $site = $this->setupDatabase($site);
        $this->setupConfig($site);
        return $site;
    }

    public function setupConfig(object $site): void
    {
        if ($site->id) {
            $this->config->set('mojar.plugin.enable_upload', false);

            $this->config->set('mojar.theme.enable_upload', false);

            $this->setCachePrefix("jw_site_{$site->id}");
        }
    }

    public function setupDatabase(object $site): object
    {
        $connection = $this->db->getDefaultConnection();

        if (!is_null($site->id)) {
            $prefix = $this->db->getTablePrefix() . "site{$site->id}_";

            $database = $this->config->get("database.connections.{$connection}");

            $database['prefix'] = $prefix;

            $this->config->set(
                'database.connections.subsite',
                $database
            );

            $this->config->set('database.default', 'subsite');

            $this->db->purge('subsite');
        }

        $site->root_connection = $connection;

        return $site;
    }

    protected function setCachePrefix($prefix): void
    {
        $this->config->set('cache.prefix', $prefix);

        $this->config->set('database.redis.options.prefix', $prefix);

        $this->config->set('mojar.cache_prefix', $prefix);
    }
}
