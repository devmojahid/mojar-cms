<?php

/**
 * JUZAWEB CMS - The Best CMS for Laravel Project
 *
 * @package    mojar/cms
 * @author     Mojar Team <admin@mojar.com>
 * @link       https://mojar.com
 * @license    MIT
 */

namespace Mojar\Translation\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AddLanguageRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'locale' => [
                'required',
                'string',
                'max:5'
            ],
        ];
    }
}
