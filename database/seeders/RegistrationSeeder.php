<?php

namespace Database\Seeders;

use App\Models\Registration;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;

class RegistrationSeeder extends Seeder
{
    public function run(): void
    {
        Schema::disableForeignKeyConstraints();

        Registration::truncate();
        Registration::factory(100)->create();

        Schema::enableForeignKeyConstraints();
    }
}
