<?php

/**
 * JUZAWEB CMS - The Best CMS for Laravel Project
 *
 * @package    mojar/cms
 * @author     Mojar Team <admin@mojar.com>
 * @link       https://mojar.com
 * @license    MIT
 */

namespace Juzaweb\CMS\Contracts;

interface StorageDataContract
{
    public function files(string $table): \RecursiveIteratorIterator;

    public function countFile(string $table): int;
}