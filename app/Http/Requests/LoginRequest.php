<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'login' => ['required', 'string', 'alpha_dash', 'max:20', 'exists:users'],
            'password' => ['required', 'string', 'min:8', 'max:30']
        ];
    }
}
