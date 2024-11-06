<?php

/**
 * JUZAWEB CMS - The Best CMS for Laravel Project
 *
 * @package    mojar/cms
 * @author     The Anh Dang <dangtheanh16@gmail.com>
 * @link       https://mojar.com/cms
 * @license    MIT
 */

namespace Mojar\Frontend\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ChangePasswordRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'current_password' => 'required',
            'password' => 'required|confirmed|string|max:32|min:6',
        ];
    }
}
