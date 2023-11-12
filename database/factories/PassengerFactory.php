<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class PassengerFactory extends Factory
{
    public function definition(): array
    {
        return [
            'pass' => fake()->unique()->numberBetween(1000, 9999),
            'full_name' => fake('ru_RU')->lastName() . ' A.A.',
            'telegram' => fake()->userName(),
        ];
    }
}
