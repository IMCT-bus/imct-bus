<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

/**
 * Проверка ФИО на соответствие формату "Иванов И.И."
 */
class FullNameRule implements ValidationRule
{
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        if (!preg_match('/^([А-ЯЁ][а-яё]*)\s+([А-ЯЁ])\.([А-ЯЁ])\.$/u', $value)) {
            $fail('Введите ФИО в формате "Иванов И.И.".');
        }
    }
}
