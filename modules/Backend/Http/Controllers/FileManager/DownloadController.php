<?php

namespace Mojar\Backend\Http\Controllers\FileManager;

use Illuminate\Support\Facades\Storage;
use Mojar\Backend\Models\MediaFile;

class DownloadController extends FileManagerController
{
    public function getDownload()
    {
        $file = $this->getPath(request()->get('file'));
        $data = MediaFile::where('path', '=', $file)->first(['name']);

        $path = Storage::disk(config('mojar.filemanager.disk'))->path($file);
        if ($data) {
            return response()->download($path, $data->name);
        }

        return response()->download($path);
    }
}
