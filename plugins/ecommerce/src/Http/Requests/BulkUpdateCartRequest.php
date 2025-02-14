<?php

namespace Mojahid\Ecommerce\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Juzaweb\Backend\Models\Post;

class BulkUpdateCartRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'items' => ['required', 'array'],
            'items.*.post_id' => [
                'bail',
                'required',
                'integer',
                'min:1',
                Rule::exists(Post::class, 'id')->where('type', 'product'),
            ],
            'items.*.type' => [
                'bail',
                'required',
                'string',
                'in:product,event'
            ],
            'items.*.quantity' => [
                'bail',
                'required',
                'integer',
                'min:1',
            ],
        ];
    }

    public function messages(): array
    {
        return [
            'items.*.post_id.exists' => trans('ecomm::content.product_not_found'),
            'items.*.quantity.min' => trans('ecomm::content.quantity_must_be_at_least_1'),
        ];
    }
}
