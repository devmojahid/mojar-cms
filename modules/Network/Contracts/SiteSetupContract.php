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

/**
 * @see \Mojar\Network\Support\SiteSetup
 */
interface SiteSetupContract
{
    public function setup(object $site): object;

    public function setupConfig(object $site): void;

    public function setupDatabase(object $site): object;
}
