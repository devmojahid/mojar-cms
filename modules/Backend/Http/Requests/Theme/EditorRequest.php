<?php

/**
 * Mojar - The Best CMS for Laravel Project
 *
 * @package    mojar/cms
 * @author     Mojar Team <admin@mojar.com>
 * @link       https://mojar.com
 * @license    MIT
 */

namespace Juzaweb\Backend\Http\Requests\Theme;

use Illuminate\Foundation\Http\FormRequest;

class EditorRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'file' => 'required',
            'content' => 'required|string|max:10000',
        ];
    }
}
