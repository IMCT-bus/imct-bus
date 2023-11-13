<?php

namespace App\Http\Requests;

use App\Rules\FullNameRule;
use App\Rules\TelegramUsernameRule;
use Illuminate\Foundation\Http\FormRequest;

class RegistrationRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'pass' => ['required', 'string', 'numeric', 'digits:4', 'exists:passengers,pass'],
            'full_name' => ['required', 'string', 'max:50', new FullNameRule()],
            'telegram' => ['nullable', 'string', 'min:5', 'max:32', new TelegramUsernameRule()],
            'stop_id' => ['required', 'integer', 'exists:stops,id'],
            'over_18' => ['required', 'boolean', 'accepted']
        ];
    }

    public function messages(): array
    {
        return [
            'pass.exists' => 'Номер пропуска не зарегистрирован.',
        ];
    }
}
