<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            UserSeeder::class,
            StopSeeder::class,
            RouteSeeder::class,
            TripSeeder::class,
            PassengerSeeder::class,
            RegistrationSeeder::class,
        ]);
    }
}
