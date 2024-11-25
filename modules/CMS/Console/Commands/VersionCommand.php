<?php

/**
 * JUZAWEB CMS - The Best CMS for Laravel Project
 *
 * @package    mojar/cms
 * @author     Mojar Team <admin@mojar.com>
 * @link       https://mojar.com
 * @license    GNU General Public License v2.0
 */

namespace Juzaweb\CMS\Console\Commands;

use Illuminate\Console\Command;
use Juzaweb\CMS\Version;

class VersionCommand extends Command
{
    protected $name = 'juza:version';

    public function handle()
    {
        echo Version::getVersion();
    }
}
