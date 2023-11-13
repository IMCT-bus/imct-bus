<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

/**
 * Поле может содержать символы a-z, 0-9 и нижнее подчёркивание.
 * Минимальная длина 5 символов, максимальная - 32.
 */
class TelegramUsernameRule implements ValidationRule
{
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        if (!preg_match('/^[a-z0-9_]{5,32}$/', $value)) {
            $fail('Невалидный telegram.');
        }
    }
}
