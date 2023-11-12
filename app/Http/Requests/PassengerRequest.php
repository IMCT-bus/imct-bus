<?php

namespace App\Http\Requests;

use App\Rules\FullNameRule;
use Illuminate\Foundation\Http\FormRequest;

class PassengerRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'pass' => ['required', 'string', 'numeric', 'digits:4', 'unique:passengers,pass'],
            'full_name' => ['required', 'string', 'max:50', new FullNameRule()]
        ];
    }

    public function messages(): array
    {
        return [
            'pass.unique' => 'Такой пропуск уже существует.',
        ];
    }
}
