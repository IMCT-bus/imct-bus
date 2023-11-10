<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TripRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'date' => ['required', 'numeric'],
            'route_id' => ['required', 'integer', 'exists:routes,id'],
            'is_published' => ['required', 'boolean'],
            'car_number' => ['nullable', 'string', 'max:10'],
            'link' => ['nullable', 'string', 'url', 'max:255'],
            'seats' => ['required', 'integer', 'between:0,255'],
        ];
    }

    public function messages(): array
    {
        return [
            'link' => 'Поле должно содержать ссылку.',
        ];
    }
}
