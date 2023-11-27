<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

/**
 * Поле может содержать символы A-z, 0-9 и нижнее подчёркивание.
 * Минимальная длина 5 символов, максимальная - 32.
 */
class TelegramUsernameRule implements ValidationRule
{
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        if (str_contains($value, 't.me/')) {
            $fail("Введите telegram username, не ссылку.");
        }

        if (str_contains($value, '@')) {
            $fail("Telegram username не должен содержать символ @.");
        }

        if (!preg_match( '/^[a-zA-Z0-9_]+$/', $value)) {
            $fail('Невалидный telegram username.');
        }
    }
}
