<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CheckoutRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name'    => ['required', 'string', 'max:100'],
            'phone'   => ['required', 'string', 'max:20'],
            'email'   => ['required', 'email', 'max:150'],
            'address' => ['nullable', 'string', 'max:300'],
            'comment' => ['nullable', 'string', 'max:500'],
        ];
    }

    public function messages(): array
    {
        return [
            'name.required'  => 'Укажите ваше имя.',
            'phone.required' => 'Укажите номер телефона.',
            'email.required' => 'Укажите эл. почту.',
//            'emails.emails'    => 'Введите корректный emails.',
        ];
    }
}
