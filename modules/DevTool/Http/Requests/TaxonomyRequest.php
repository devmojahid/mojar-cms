<?php

/**
 * Mojar - Laravel CMS for Your Project
 *
 * @package    mojar/juzacms
 * @author     The Anh Dang
 * @link       https://mojar.com
 * @license    GNU V2
 */

namespace Juzaweb\DevTool\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TaxonomyRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'key' => ['required', 'string'],
            'label' => ['required', 'string'],
            'menu_position' => ['required', 'numeric', 'min:1'],
            'description' => ['nullable', 'string', 'max:250'],
            'supports' => ['nullable', 'array'],
        ];
    }

    protected function prepareForValidation(): void
    {
        $this->merge(
            [
                'menu_position' => (int) $this->input('menu_position', 0),
                'supports' => (array) $this->input('supports', []),
            ]
        );
    }
}
