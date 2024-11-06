<?php

/**
 * JUZAWEB CMS - Laravel CMS for Your Project
 *
 * @package    mojar/cms
 * @author     The Anh Dang
 * @link       https://mojar.com/cms
 * @license    GNU V2
 */

namespace Mojar\Tests\Feature\Backend;

use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Mojar\Tests\TestCase;

class PluginTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();

        $this->authUserAdmin();
    }

    public function testIndexPlugin()
    {
        $this->get("/admin-cp/plugins")
            ->assertStatus(200);
    }

    public function testActivePlugin()
    {
        $this->json(
            'POST',
            'admin-cp/plugins/bulk-actions',
            [
                'ids' => ['mojar/example'],
                'action' => 'activate'
            ]
        )
            ->assertJson(['status' => true]);
    }

    public function testDeactivePlugin()
    {
        $this->json(
            'POST',
            'admin-cp/plugins/bulk-actions',
            [
                'ids' => ['mojar/example'],
                'action' => 'deactivate'
            ]
        )
            ->assertJson(['status' => true]);
    }

    public function testDeletePlugin()
    {
        config()->set('mojar.plugin.enable_upload', true);

        $pluginName = 'mojar/example';

        $pluginPath = config('mojar.plugin.path') . "/example";

        $destination = Storage::disk('local')->path("backups/example");

        File::copyDirectory($pluginPath, $destination);

        $this->json(
            'POST',
            'admin-cp/plugins/bulk-actions',
            [
                'ids' => [$pluginName],
                'action' => 'delete'
            ]
        )
            ->assertJson(['status' => true]);

        $this->assertFileDoesNotExist(
            $pluginPath . "/composer.json"
        );

        File::copyDirectory($destination, $pluginPath);

        $this->assertFileExists(
            $pluginPath . "/composer.json"
        );
    }
}
