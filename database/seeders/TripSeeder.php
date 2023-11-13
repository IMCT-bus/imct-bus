<?php

namespace Database\Seeders;

use App\Models\Trip;
use Database\Factories\RouteFactory;
use DateTime;
use DateTimeZone;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;

class TripSeeder extends Seeder
{
    public function run(): void
    {
        Schema::disableForeignKeyConstraints();

        Trip::truncate();

        $date = new DateTime('-2 days');
        $isPublished = true;
        $routeIds = array_column(RouteFactory::ROUTES, 'id');

        for ($i = 0; $i < 5; $i++) {
            if ($date->format('Y-m-d') == (new DateTime('+1 day'))->format('Y-m-d')) {
                $isPublished = false;
            }

            foreach ($routeIds as $routeId) {
                Trip::factory()->create([
                    'date' => $date,
                    'route_id' => $routeId,
                    'is_published' => $isPublished,
                ]);
            }

            $date->modify('+1 day');
        }

        Schema::enableForeignKeyConstraints();
    }
}
