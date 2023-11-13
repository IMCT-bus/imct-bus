<?php

namespace Database\Factories;

use App\Models\Passenger;
use App\Models\Registration;
use App\Models\Stop;
use App\Models\Trip;
use DateTime;
use DateTimeZone;
use Illuminate\Database\Eloquent\Factories\Factory;

class RegistrationFactory extends Factory
{
    public const TIMEZONE = 'Asia/Vladivostok';

    public function definition(): array
    {
        return [
            'passenger_id' => fake()->randomElement(Passenger::query()->pluck('id')),
            'trip_uuid' => fake()->randomElement(Trip::query()->pluck('uuid')),
            'stop_id' => fake()->randomElement(Stop::query()->pluck('id')),
            'created_at' => new DateTime('now', new DateTimeZone(self::TIMEZONE)),
            'updated_at' => new DateTime('now', new DateTimeZone(self::TIMEZONE)),
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
                Registration::whereIn('id', $entriesToDelete)->update([
                    'deleted_at' => new DateTime('now', new DateTimeZone(self::TIMEZONE)),
                    'updated_at' => new DateTime('now', new DateTimeZone(self::TIMEZONE)),
                ]);
            }
        });
    }
}
