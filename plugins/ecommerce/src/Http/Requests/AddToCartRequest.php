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
use Illuminate\Support\Facades\Log;

class AddToCartRequest extends FormRequest
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
            'post_id.exists' => 'Product not found or not available',
            'post_id.required' => 'Product ID is required',
            'quantity.min' => 'Quantity must be at least 1',
            'type.in' => 'Invalid product type specified'
        ];
    }

    protected function prepareForValidation()
    {
        Log::info('AddToCart Request Data:', $this->all());
    }
}
