<?php

/**
 * JUZAWEB CMS - The Best CMS for Laravel Project
 *
 * @package    mojar/cms
 * @author     Mojar Team <admin@mojar.com>
 * @link       https://mojar.com
 * @license    MIT
 */

namespace Juzaweb\Backend\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class ProfileUpdateRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name' => [
                'bail',
                'required',
                'string',
                'max:150'
            ],
            'avatar' => [
                'nullable',
                'string',
                'max:150'
            ],
            'language' => [
                'required',
                'nullable',
                'string',
                'max:5'
            ],
            'metas' => [
                'bail',
                'array'
            ],
            'metas.birthday' => [
                'bail',
                'nullable',
                'string',
            ],
            'metas.country' => [
                'bail',
                'nullable',
                'string',
            ]
        ];
    }
}
