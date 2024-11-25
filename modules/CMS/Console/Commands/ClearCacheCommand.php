<?php

/**
 * JUZAWEB CMS - Laravel CMS for Your Project
 *
 * @package    mojar/cms
 * @author     The Anh Dang
 * @link       https://mojar.com/cms
 * @license    GNU V2
 */

namespace Juzaweb\CMS\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Cache;

class ClearCacheCommand extends Command
{
    protected $signature = 'juzacms:clear-cache';

    public function handle(): int
    {
        if (config('cache.default') != 'file') {
            Cache::clear();
        }

        Cache::store('file')->clear();

        $this->info('Caches cleared successfully.');

        return self::SUCCESS;
    }
}
