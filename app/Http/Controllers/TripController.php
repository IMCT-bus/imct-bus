<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegistrationRequest;
use App\Http\Resources\TripResource;
use App\Models\Passenger;
use App\Models\Registration;
use App\Models\Trip;
use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;
use Inertia\Response;

class TripController extends BaseController
{
    public function index(): Response
    {
        $trips = TripResource::collection(
            Trip::with('route')
                ->withCount('registrations')
                ->published()
                ->todayAndLater()
                ->join('routes', 'routes.id', '=', 'trips.route_id')
                ->orderByRaw('date DESC, routes.starts_at ASC')
                ->get()
        );

        return inertia('Trips/Index', ['trips' => $trips]);
    }

    public function showRegister(Trip $trip): Response
    {
        //TODO: gate, если места закончились?
        return inertia('Trips/Register', [
            'trip' => new TripResource($trip->load('route'))
        ]);
    }

    public function register(RegistrationRequest $request, Trip $trip): RedirectResponse
    {
        $validated = $request->validated();

        $passenger = Passenger::query()
            ->where('pass', $validated['pass'])
            ->where('full_name', $validated['full_name'])
            ->first();

        if (is_null($passenger)) {
            return back()->withErrors(['wrongPassengerDataError' => 'Неверное ФИО или номер пропуска.']);
        }

        if (Registration::query()
            ->where('passenger_id', $passenger->id)
            ->where('trip_uuid', $trip->uuid)
            ->exists()
        ) {
            return back()->withErrors(['alreadyRegisteredError' => 'Пассажир с этим пропуском уже зарегистрирован на рейс.']);
        }

        if (!$trip->is_published || $trip->loadCount('registrations') >= $trip->seats) {
            return back()->withErrors(['registrationClosedError' => 'Регистрация на рейс закрыта.']);
        }

        DB::beginTransaction();
        try {
            DB::table('registrations')
                ->where('trip_uuid', $trip->uuid)
                ->lockForUpdate()
                ->get();

            DB::table('registrations')->insert([
                'passenger_id' => $passenger->id,
                'trip_uuid' => $trip->uuid,
                'stop_id' => $validated['stop_id'],
            ]);

            DB::commit();
        } catch (Exception $e) {
            DB::rollback();
            // Обработка ошибки, если регистрация не удалась
        }

        return redirect()->route('trips.index');
    }

    public function showCancel(): Response
    {
        return inertia('Trips/Cancel', [
            'trips' => TripResource::collection(Trip::with('route')
                ->published()
                ->todayAndLater()
                ->join('routes', 'routes.id', '=', 'trips.route_id')
                ->orderByRaw('date DESC, routes.starts_at ASC')
                ->get())
        ]);
    }

    public function cancel(Trip $trip): RedirectResponse
    {
        //TODO: отмена регистрации

        return redirect()->route('trips.index');
    }
}
