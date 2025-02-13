<?php
/**
 * JUZAWEB CMS - The Best CMS for Laravel Project
 *
 * @package    juzaweb/cms
 * @author     The Anh Dang <dangtheanh16@gmail.com>
 * @link       https://juzaweb.com/cms
 * @license    MIT
 */

namespace Mojahid\Ecommerce\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Juzaweb\Backend\Models\Post;

class AddToCartRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'post_id' => [
                'bail',
                'required',
                'integer',
                'min:1',
                Rule::exists(Post::class, 'id')->where('type', 'product'),
            ],
            'type' => [
                'bail', 
                'required',
                'string',
                'in:product,event'
            ],
            'quantity' => [
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
            'post_id.exists' => trans('ecomm::content.product_not_found'),
            'quantity.min' => trans('ecomm::content.quantity_must_be_at_least_1'),
        ];
    }
}
