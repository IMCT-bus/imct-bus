<?php

namespace Database\Factories;

use App\Models\Passenger;
use App\Models\Registration;
use App\Models\Stop;
use App\Models\Trip;
use Illuminate\Database\Eloquent\Factories\Factory;

class RegistrationFactory extends Factory
{
    public function definition(): array
    {
        $trip = Trip::query()
            ->where('is_published', true)
            ->orderByRaw('RAND()')
            ->first();

        return [
            'passenger_id' => fake()->randomElement(Passenger::query()->pluck('id')),
            'telegram' => str_replace('.', '', fake()->userName()),
            'trip_uuid' => $trip->uuid,
            'stop_id' => fake()->randomElement($trip->route->stops->pluck('id')),
        ];
    }

    public function configure(): RegistrationFactory
    {
        return $this->afterCreating(function ($registration) {
            $duplicates = Registration::query()
                ->where('passenger_id', $registration['passenger_id'])
                ->where('trip_uuid', $registration['trip_uuid'])
                ->pluck('id');

            if ($duplicates->count() > 1) {
                $entriesToDelete = $duplicates->skip(1);
                Registration::whereIn('id', $entriesToDelete)->delete();
            }
        });
    }
}
