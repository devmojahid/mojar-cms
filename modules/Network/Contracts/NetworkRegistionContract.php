<?php

/**
 * JUZAWEB CMS - The Best CMS for Laravel Project
 *
 * @package    mojar/cms
 * @author     Mojar Team <admin@mojar.com>
 * @link       https://mojar.com
 * @license    MIT
 */

namespace Juzaweb\Network\Contracts;

interface NetworkRegistionContract
{
    public function init(): void;

    public function getCurrentSiteId(): ?int;

    public function getCurrentSite(): object;

    public function isRootSite($domain = null): bool;

    public function getCurrentDomain(): string;
}
