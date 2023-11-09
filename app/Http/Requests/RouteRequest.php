<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RouteRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:203'],
            'starts_at' => ['required', 'string', 'date_format:H:i'],
            'stops' => ['required', 'array'],
            'stops.*.name' => ['required', 'string', 'max:100'],
            'stops.*.link' => ['nullable', 'string', 'url', 'max:255'],
            'stops.*.arrives_at' => ['nullable', 'string', 'date_format:H:i'],
        ];
    }
}
