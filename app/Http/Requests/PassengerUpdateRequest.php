<?php

namespace App\Http\Requests;

use App\Rules\FullNameRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class PassengerUpdateRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'pass' => ['nullable', 'string', 'numeric', 'digits:4',
                Rule::unique('passengers', 'pass')->ignore($this->route('passenger.id'))
            ],
            'full_name' => ['nullable', 'string', 'max:50', new FullNameRule()]
        ];
    }

    public function messages(): array
    {
        return [
            'pass.unique' => 'Такой пропуск уже существует.',
        ];
    }
}
