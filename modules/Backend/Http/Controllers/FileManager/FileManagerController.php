<?php

namespace Juzaweb\Backend\Http\Controllers\FileManager;

use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Juzaweb\CMS\Http\Controllers\BackendController;

class FileManagerController extends BackendController
{
    protected static string $success_response = 'OK';

    public function index(Request $request): View
    {
        $type = $this->getType();
        $mimeTypes = config("mojar.filemanager.types.{$type}.valid_mime");
        $maxSize = config("mojar.filemanager.types.{$type}.max_size");
        $multiChoose = $request->get('multichoose', 0);
        $folderId = $request->get('folderId', 0);

        if (empty($mimeTypes)) {
            abort(404);
        }

        if ($folderId) {
            $this->addBreadcrumb(
                [
                    'title' => $title,
                    'url' => route('admin.media.index'),
                ]
            );

            $folder = $this->folderRepository->find($folderId);
            $folder->load('parent');
            $this->addBreadcrumbFolder($folder);
            $title = $folder->name;
        }

        return view(
            'cms::backend.filemanager.index',
            [
                'fileTypes' => $this->getFileTypes(),
                'mimeTypes' => $mimeTypes,
                'maxSize' => $maxSize,
                'multiChoose' => $multiChoose,
                'type' => $type,
                'folderId' => $folderId,
            ]
        );
    }

    public function getErrors(): array
    {
        $errors = [];
        if (! extension_loaded('gd') && ! extension_loaded('imagick')) {
            $errors[] = trans('cms::filemanager.message_extension_not_found', ['name' => 'gd']);
        }

        if (! extension_loaded('exif')) {
            $errors[] = trans('cms::filemanager.message_extension_not_found', ['name' => 'exif']);
        }

        if (! extension_loaded('fileinfo')) {
            $errors[] = trans('cms::filemanager.message_extension_not_found', ['name' => 'fileinfo']);
        }

        return $errors;
    }

    public function throwError($type, $variables = [])
    {
        throw new \Exception(trans('cms::filemanager.error_' . $type, $variables));
    }

    protected function getType(): string
    {
        $type = strtolower(request()->get('type'));

        return Str::singular($type);
    }

    protected function getPath($url): string
    {
        $explode = explode('uploads/', $url);
        if (isset($explode[1])) {
            return $explode[1];
        }

        return $url;
    }

    protected function isDirectory($file): bool
    {
        if (is_numeric($file)) {
            return true;
        }

        return false;
    }

    protected function getFileTypes()
    {
        return config('mojar.filemanager.types');
    }
}
