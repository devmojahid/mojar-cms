<?php

/**
 * Mojar - The Best CMS for Laravel Project
 *
 * @package    mojar/cms
 * @author     The Anh Dang <dangtheanh16@gmail.com>
 * @link       https://mojar.com/cms
 * @license    MIT
 */

namespace Juzaweb\Frontend\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProfileRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:150',
            'phone' => 'nullable|string|max:20',
            'password' => 'nullable|confirmed|string|max:32|min:6',
            'password_confirmation' => 'nullable|required_if:password,!=,|string|max:32|min:6',
            'avatar' => [
                'nullable'
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
            ],
            'metas.address' => [
                'bail',
                'nullable',
                'string',
            ],
            'metas.city' => [
                'bail',
                'nullable',
                'string',
            ],
            'metas.state' => [
                'bail',
                'nullable',
                'string',
            ],
            'metas.zip_code' => [
                'bail',
                'nullable',
                'string',
            ],
            'metas.bio' => [
                'bail',
                'nullable',
                'string',
            ]
        ];
    }
}
