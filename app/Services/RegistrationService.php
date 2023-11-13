<?php

namespace App\Services;

use App\Models\Passenger;
use App\Models\Registration;
use App\Models\Trip;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

class RegistrationService
{
    /**
     * @throws ValidationException
     */
    public function create(array $validated, Trip $trip): void
    {
        $passenger = Passenger::findByCredentials($validated['pass'], $validated['full_name']);

        if ($passenger) {
            $passenger->update(['telegram' => $validated['telegram']]);
        } else {
            throw ValidationException::withMessages(['wrongPassengerDataError' => 'Неверное ФИО или номер пропуска.']);
        }

        if (Registration::findByTripAndPassenger($trip->uuid, $passenger->id)) {
            throw ValidationException::withMessages(['alreadyRegisteredError' => 'Пассажир с этим пропуском уже зарегистрирован на рейс.']);
        }

        if (!$trip->is_published || $trip->loadCount('registrations')->registrations_count >= $trip->seats) {
            throw ValidationException::withMessages(['registrationClosedError' => 'Регистрация на рейс закрыта.']);
        }

        $this->startTransaction($trip->uuid, $passenger->id, $validated['stop_id']);
    }

    /**
     * @throws ValidationException
     */
    public function destroy(array $validated, Trip $trip): void
    {
        $passenger = Passenger::findByCredentials($validated['pass'], $validated['full_name']);

        if (!$passenger) {
            throw ValidationException::withMessages(['wrongRegistrationDataError' => 'Не удалось найти регистрацию.']);
        }

        $registration = Registration::findByTripAndPassenger($trip->uuid, $passenger->id);

        if (!$registration) {
            throw ValidationException::withMessages(['wrongRegistrationDataError' => 'Не удалось найти регистрацию.']);
        }

        $registration->delete();
    }

    private function startTransaction(string $tripUuid, int $passengerId, int $stopId): void
    {
        DB::beginTransaction();
        try {
            DB::table('registrations')
                ->where('trip_uuid', $tripUuid)
                ->lockForUpdate()
                ->get();

            DB::table('registrations')->insert([
                'passenger_id' => $passengerId,
                'trip_uuid' => $tripUuid,
                'stop_id' => $stopId,
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            DB::commit();
        } catch (Exception $e) {
            DB::rollback();
            // Обработка ошибки, если регистрация не удалась
        }
    }

}