<?php

namespace Database\Seeders;

use App\Models\Route;
use Database\Factories\RouteFactory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;

class RouteSeeder extends Seeder
{
    public function run(): void
    {
        Schema::disableForeignKeyConstraints();

        Route::truncate();

        foreach (RouteFactory::ROUTES as $routeData) {
            $route = Route::create([
                'id' => $routeData['id'],
                'name' => $routeData['name'],
                'starts_at' => $routeData['starts_at']
            ]);

            foreach ($routeData['stopsIds'] as $index => $stopId) {
                $arrivesAt = $routeData['arrivesAtValues'][$index] ?? null;
                $route->stops()->attach($stopId, ['arrives_at' => $arrivesAt]);
            }
        }

        Schema::enableForeignKeyConstraints();
    }
}
