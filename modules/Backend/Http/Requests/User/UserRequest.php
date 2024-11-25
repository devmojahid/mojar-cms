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
use Juzaweb\CMS\Models\User;

class UserRequest extends FormRequest
{
    public function rules(): array
    {
        $allStatus = array_keys(User::getAllStatus());

        return [
            'name' => [
                'bail',
                'required',
                'min:5',
            ],
            'avatar' => 'nullable|string|max:150',
            'status' => 'required|in:' . implode(',', $allStatus),
        ];
    }
}
