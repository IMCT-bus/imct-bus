<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('passengers', function (Blueprint $table) {
            $table->id();
            $table->string('pass', 4)->unique();
            $table->string('full_name', 50);
            $table->string('telegram', 32)->nullable();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('passengers');
    }
};
