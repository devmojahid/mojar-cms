<?php
/**
 * JUZAWEB CMS - Laravel CMS for Your Project
 *
 * @package    juzaweb/cms
 * @author     The Anh Dang
 * @link       https://juzaweb.com
 * @license    GNU V2
 */

namespace Mojahid\ContactForm\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreContactRequest extends FormRequest
{
    public function rules(): array
    {
        $rules = [
            'name' => ['required', 'string', 'max:250'],
            'email' => ['required', 'string', 'email', 'max:250'],
            'subject' => ['required', 'string', 'max:250'],
            'message' => ['required', 'string'],
        ];

        if (get_config('captcha')) {
            $rules['g-recaptcha-response'] = ['bail,required,recaptcha'];
        }

        return $rules;
    }
}
