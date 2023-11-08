<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        Schema::disableForeignKeyConstraints();

        User::truncate();
        User::factory()->create(['login' => 'root']);

        Schema::enableForeignKeyConstraints();
    }
}
