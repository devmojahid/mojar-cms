<?php

/**
 * Mojar - Laravel CMS for Your Project
 *
 * @package    mojar/cms
 * @author     The Anh Dang
 * @link       https://mojar.com/cms
 * @license    GNU V2
 */

namespace Juzaweb\Tests\Unit;

use Illuminate\Support\Facades\Storage;
use Juzaweb\CMS\Models\User;
use Juzaweb\CMS\Support\FileManager;
use Juzaweb\Tests\TestCase;

class MediaTest extends TestCase
{
    public function testUploadByPath()
    {
        Storage::put('tmps/test.gif', base64_decode('R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw=='));

        $media = FileManager::addFile(
            Storage::path('tmps/test.gif'),
            'file',
            null,
            User::first()->id
        );

        $this->assertNotEmpty($media->path);

        $this->assertFileDoesNotExist(Storage::path('tmps/test.gif'));
    }

    public function testUploadByUrl()
    {
        $img = 'https://cdn.mojar.com/jw-styles/mojar/images/thumb-default.png';

        $media = FileManager::addFile($img, 'image', null, User::first()->id);

        $this->assertNotEmpty($media->path);

        $this->assertFileExists(
            Storage::disk('public')->path($media->path)
        );
    }
}
