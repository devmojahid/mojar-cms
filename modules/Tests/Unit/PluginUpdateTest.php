<?php

/**
 * JUZAWEB CMS - Laravel CMS for Your Project
 *
 * @package    mojar/cms
 * @author     The Anh Dang
 * @link       https://mojar.com/cms
 * @license    GNU V2
 */

namespace Mojar\Tests\Unit;

use Illuminate\Support\Facades\File;
use Mojar\CMS\Facades\Plugin;
use Mojar\CMS\Support\Updater\PluginUpdater;
use Mojar\Tests\TestCase;

class PluginUpdateTest extends TestCase
{
    public function testInstall()
    {
        $updater = app(PluginUpdater::class)->find('mojar/movie');

        $updater->update();

        $this->assertDirectoryExists(
            config('mojar.plugin.path') . "/movie"
        );

        $plugin = Plugin::find('mojar/movie');

        $this->assertNotEmpty($plugin);
    }

    public function testUpdate()
    {
        $plugin = Plugin::find('mojar/movie');

        $composer = File::get($plugin->getPath() . "/composer.json");

        $composer = str_replace($plugin->getVersion(), '1.0', $composer);

        File::put($plugin->getPath() . "/composer.json", $composer);

        $plugin = Plugin::find('mojar/movie');
        $this->assertEquals($plugin->getVersion(), '1.0');

        $updater = app(PluginUpdater::class)->find('mojar/movie');

        $updater->update();

        $plugin = Plugin::find('mojar/movie');
        $this->assertNotEquals($plugin->getVersion(), '1.0');
    }
}
