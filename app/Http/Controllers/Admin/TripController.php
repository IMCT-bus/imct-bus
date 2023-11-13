<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\BaseController;
use App\Http\Requests\TripRequest;
use App\Http\Resources\RouteResource;
use App\Http\Resources\TripResource;
use App\Models\Route;
use App\Models\Trip;
use Carbon\Carbon;
use Illuminate\Http\RedirectResponse;
use Inertia\Response;

class TripController extends BaseController
{
    public function index(): Response
    {
        $trips = TripResource::collection(
            Trip::with('route')
                ->join('routes', 'routes.id', '=', 'trips.route_id')
                ->orderByRaw('date DESC, routes.starts_at ASC')
                ->get()
        );

        return inertia('Admin/Trips/Index', ['trips' => $trips]);
    }

    public function show(Trip $trip): Response
    {
        return inertia('Admin/Trips/Index', [
            'trip' => new TripResource($trip->load('route'))
        ]);
    }

    public function create(): Response
    {
        return inertia('Admin/Trips/Create', [
            'routes' => RouteResource::collection(
                Route::with('stops')->orderBy('starts_at')->get()
            )
        ]);
    }

    public function store(TripRequest $request): RedirectResponse
    {
        $validated = $request->validated();

        Trip::create([...$validated,
            'date' => Carbon::createFromTimestampMs($validated['date'])
        ]);

        return redirect()->route('admin.trips.index');
    }

    public function edit(Trip $trip): Response
    {
        $routes = RouteResource::collection(
            Route::with('stops')->orderBy('starts_at')->get()
        );

        return inertia('Admin/Trips/Edit', [
            'trip' => new TripResource($trip->load('route')),
            'routes' => $routes
        ]);
    }

    public function update(TripRequest $request, Trip $trip): RedirectResponse
    {
        $validated = $request->validated();

        $trip->update([...$validated,
            'date' => Carbon::createFromTimestampMs($validated['date'])
        ]);

        return redirect()->route('admin.trips.index');
    }

    public function destroy(Trip $trip): RedirectResponse
    {
        $trip->delete();

        return redirect()->route('admin.trips.index');
    }
}
