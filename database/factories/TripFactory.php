<?php

namespace Database\Factories;

use App\Models\Route;
use Illuminate\Database\Eloquent\Factories\Factory;

class TripFactory extends Factory
{
    public function definition(): array
    {
        return [
            'uuid' => fake()->uuid(),
            'date' => fake()->date(),
            'route_id' => fake()->randomElement(Route::query()->pluck('id')),
            'is_published' => fake()->boolean(60),
            'car_number' => 'А 123 БВ',
            'link' => fake()->url(),
            'seats' => fake()->numberBetween(10, 40),
        ];
    }
}
