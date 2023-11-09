<?php

namespace App\Services;

use App\Models\Route;
use App\Models\Stop;

class RouteService
{
    public function create(array $validated): void
    {
        $route = Route::create([
            'name' => $validated['name'],
            'starts_at' => $validated['starts_at'],
        ]);

        $this->syncStops($route, $validated['stops']);
    }

    public function update(array $validated, Route $route): void
    {
        $route->update([
            'name' => $validated['name'],
            'starts_at' => $validated['starts_at'],
        ]);

        $route->stops()->detach();
        $this->syncStops($route, $validated['stops']);
    }

    private function syncStops(Route $route, array $stops): void
    {
        foreach ($stops as $stop) {
            $stopId = Stop::firstOrCreate([
                'name' => $stop['name'],
                'link' => $stop['link'],
            ])->id;

            $route->stops()->attach(
                $stopId,
                ['arrives_at' => $stop['arrives_at'], 'position' => $stop['position']]
            );
        }
    }

}
