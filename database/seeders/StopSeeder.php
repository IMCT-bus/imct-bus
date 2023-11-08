<?php

namespace Database\Seeders;

use App\Models\Stop;
use Database\Factories\StopFactory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;

class StopSeeder extends Seeder
{
    public function run(): void
    {
        Schema::disableForeignKeyConstraints();

        Stop::truncate();
        foreach (StopFactory::STOPS as $stopData) {
            Stop::create($stopData);
        }

        Schema::enableForeignKeyConstraints();
    }
}
