<?php

namespace App\Http\Controllers;

use App\Http\Resources\TripResource;
use App\Models\Trip;
use Illuminate\Http\RedirectResponse;
use Inertia\Response;

class TripController extends BaseController
{
    public function index(): Response
    {
        $trips = TripResource::collection(
            Trip::with('route')
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
        return inertia('Trips/Register', [
            'trip' => new TripResource($trip->load('route'))
        ]);
    }

    public function register(): RedirectResponse
    {
        //TODO: регистрация

        return redirect()->route('trips.index');
    }

    public function showCancel(Trip $trip): Response
    {
        return inertia('Trips/Cancel', [
            'trip' => new TripResource($trip->load('route'))
        ]);
    }

    public function cancel(): RedirectResponse
    {
        //TODO: отмена регистрации

        return redirect()->route('trips.index');
    }
}
