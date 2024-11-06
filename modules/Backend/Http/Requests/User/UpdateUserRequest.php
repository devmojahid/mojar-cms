<?php

/**
 * JUZAWEB CMS - The Best CMS for Laravel Project
 *
 * @package    mojar/cms
 * @author     Mojar Team <admin@mojar.com>
 * @link       https://mojar.com
 * @license    MIT
 */

namespace Mojar\Backend\Http\Requests\User;

use Illuminate\Validation\Rule;
use Mojar\CMS\Models\User;

class UpdateUserRequest extends UserRequest
{
    public function rules(): array
    {
        $rules = parent::rules();
        $rules['email'] = [
            'bail',
            'required',
            'email',
            'max:150',
            Rule::modelUnique(User::class, 'email')
        ];
        $rules['password'] = [
            'bail',
            'required',
            'min:6',
            'max:32',
        ];
        return $rules;
    }
}
