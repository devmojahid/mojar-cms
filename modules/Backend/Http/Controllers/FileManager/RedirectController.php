<?php

namespace Mojar\Backend\Http\Controllers\FileManager;

use Illuminate\Support\Facades\Storage;

class RedirectController extends FileManagerController
{
    public function showFile($file_path)
    {
        $storage = Storage::disk(config('mojar.filemanager.disk'));

        if (! $storage->exists($file_path)) {
            abort(404);
        }

        return response($storage->get($file_path))
            ->header('Content-Type', $storage->mimeType($file_path));
    }
}
