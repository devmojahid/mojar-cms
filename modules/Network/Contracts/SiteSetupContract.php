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

/**
 * @see \Juzaweb\Network\Support\SiteSetup
 */
interface SiteSetupContract
{
    public function setup(object $site): object;

    public function setupConfig(object $site): void;

    public function setupDatabase(object $site): object;
}
