<?php

namespace Mojahid\Ecommerce\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Juzaweb\CMS\Models\PaymentMethod;

class CheckoutRequest extends FormRequest
{
    public function rules(): array
    {
        global $jw_user;

        $rules = [];

        if (empty($jw_user)) {
            $rules['email'] = [
                'bail',
                'required',
                'email:rfc,dns',
                'max:150',
            ];

            $rules['name'] = [
                'bail',
                'required',
                'max:150',
            ];
        }

        $rules['notes'] = [
            'bail',
            'nullable',
            'max:500',
        ];

        $rules['payment_method_id'] = [
            'bail',
            'required',
            'integer',
            Rule::modelExists(PaymentMethod::class),
        ];

        return $rules;
    }
}
