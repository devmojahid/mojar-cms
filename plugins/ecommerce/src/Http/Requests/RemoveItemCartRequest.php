<?php

namespace Mojahid\Ecommerce\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Juzaweb\Backend\Models\Post;

class RemoveItemCartRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'post_id' => [
                'bail',
                'required',
                'integer'
            ],
            'type' => [
                'bail',
                'required',
                'string'
            ]
        ];
    }

    public function messages(): array
    {
        return [
            'post_id.exists' => trans('ecomm::content.product_not_found'),
        ];
    }
}
