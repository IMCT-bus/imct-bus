<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class RouteFactory extends Factory
{
    public const ROUTES = [
        ['id' => 1, 'name' => 'Парк победы - Кампус ДВФУ', 'starts_at' => '7:15',
            'stopsIds' => [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12]
        ],
        ['id' => 2, 'name' => 'Баляева - Кампус ДВФУ', 'starts_at' => '8:30',
            'stopsIds' => [13, 14, 15, 16, 12]
        ],
        ['id' => 3, 'name' => 'Кампус ДВФУ - Парк победы', 'starts_at' => '18:45',
            'stopsIds' => [17, 18, 19, 20, 6, 21, 22, 23, 24]
        ],
    ];

    public function definition(): array
    {
        $selectedRoute = $this->faker->randomElement(self::ROUTES);

        return [
            'id' => $selectedRoute['id'],
            'name' => $selectedRoute['name'],
            'starts_at' => $selectedRoute['starts_at'],
        ];
    }
}
