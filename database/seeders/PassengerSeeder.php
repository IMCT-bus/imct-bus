<?php

namespace Database\Seeders;

use App\Models\Passenger;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;

class PassengerSeeder extends Seeder
{
    public function run(): void
    {
        Schema::disableForeignKeyConstraints();

        Passenger::truncate();
        Passenger::factory(20)->create();

        Schema::enableForeignKeyConstraints();
    }
}
