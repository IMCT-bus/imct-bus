<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('trips', function (Blueprint $table) {
            $table->uuid()->primary();
            $table->date('date');
            $table->foreignId('route_id')->constrained()->cascadeOnDelete();
            $table->boolean('is_published')->default(false);
            $table->string('car_number', 10)->nullable();
            $table->string('link')->nullable();
            $table->unsignedTinyInteger('seats');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('trips');
    }
};
