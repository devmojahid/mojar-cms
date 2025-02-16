<?php

/**
 * Mojar - The Best CMS for Laravel Project
 *
 * @package    mojar/cms
 * @author     Mojar Team <admin@mojar.com>
 * @link       https://mojar.com
 * @license    MIT
 */

namespace Juzaweb\Backend\Http\Requests\Media;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Juzaweb\Backend\Models\MediaFolder;

class AddFolderRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name' => [
                'required',
                'string',
                'max:150',
                Rule::modelUnique(
                    MediaFolder::class,
                    'name',
                    function ($q) {
                        $q->where('name', '=', $this->input('name'));
                        $q->where('folder_id', '=', $this->input('folder_id'));
                    }
                )
            ],
            'folder_id' => 'nullable|exists:media_folders,id',
        ];
    }

    public function attributes(): array
    {
        return [
            'name' => trans('cms::filemanager.folder-name'),
            'folder_id' => trans('cms::filemanager.parent'),
        ];
    }
}
