<?php

/**
 * Mojar - The Best CMS for Laravel Project
 *
 * @package    mojar/cms
 * @author     Mojar Team <admin@mojar.com>
 * @link       https://mojar.com
 * @license    MIT
 */

namespace Juzaweb\Network\Commands;

use Illuminate\Console\Command;

class ArtisanCommand extends Command
{
    protected $signature = 'network:run {cmd} {site} {options?}';

    protected $description = 'Run artisan commands subsite.';

    public function handle(): int
    {
        $command = $this->argument('cmd');

        $options = $this->argument('options');

        $options = $options ? json_decode($options, true) : [];

        $this->call($command, $options);

        return self::SUCCESS;
    }
}
