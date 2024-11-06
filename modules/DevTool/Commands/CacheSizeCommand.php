<?php

/**
 * JUZAWEB CMS - The Best CMS for Laravel Project
 *
 * @package    mojar/cms
 * @author     Mojar Team <admin@mojar.com>
 * @link       https://mojar.com
 * @license    MIT
 */

namespace Mojar\DevTool\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class CacheSizeCommand extends Command
{
    protected $name = 'cache:size';

    public function handle(): void
    {
        $fileSize = 0;
        foreach (File::allFiles(storage_path('framework/cache')) as $file) {
            $fileSize += $file->getSize();
        }

        $this->info("Current cache site: " . format_size_units($fileSize));
    }
}
