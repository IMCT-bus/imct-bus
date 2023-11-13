<?php

namespace Database\Factories;

use App\Models\Route;
use Illuminate\Database\Eloquent\Factories\Factory;

class TripFactory extends Factory
{
    public function definition(): array
    {
        $carNumber = random_int(1, 100) <= 50 ? null : 'А ' . random_int(111, 999) . ' БВ';
        $link = random_int(1, 100) <= 50 ? null : fake()->url();

        return [
            'uuid' => fake()->uuid(),
            'date' => fake()->date(),
            'route_id' => fake()->randomElement(Route::query()->pluck('id')),
            'is_published' => fake()->boolean(60),
            'car_number' => $carNumber,
            'link' => $link,
            'seats' => fake()->numberBetween(10, 40),
        ];
    }
}
