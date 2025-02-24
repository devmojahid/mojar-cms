<?php

namespace Mojahid\EventManagement\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BookingRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'ticket_id' => 'required|exists:evman_event_tickets,id',
            'quantity' => 'required|integer|min:1',
            'name' => 'required|string',
            'email' => 'required|email',
            'phone' => 'required',
            'payment_method_id' => 'required|exists:payment_methods,id'
        ];
    }
} 