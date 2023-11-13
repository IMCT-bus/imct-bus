<?php

namespace App\Http\Requests;

use App\Rules\FullNameRule;
use Illuminate\Foundation\Http\FormRequest;

class CancellationRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'pass' => ['required', 'string', 'numeric', 'digits:4'],
            'full_name' => ['required', 'string', 'max:50', new FullNameRule()],
            'trip_uuid' => ['required', 'uuid', 'exists:trips,uuid'],
        ];
    }
}
