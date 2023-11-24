<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\BaseController;
use App\Http\Requests\PassengerCreateRequest;
use App\Http\Requests\PassengerUpdateRequest;
use App\Models\Passenger;
use Illuminate\Http\RedirectResponse;
use Inertia\Response;

class PassengerController extends BaseController
{
    public function index(): Response
    {
        return inertia('Admin/Passengers/Index', [
            'passengers' => Passenger::query()->orderBy('full_name')->get()
        ]);
    }

    public function store(PassengerCreateRequest $request): RedirectResponse
    {
        $validated = $request->validated();

        Passenger::create($validated);

        return back();
    }

    public function update(PassengerUpdateRequest $request, Passenger $passenger): RedirectResponse
    {
        $validated = $request->validated();

        $passenger->update(array_filter($validated));

        return back();
    }

    public function destroy(Passenger $passenger): RedirectResponse
    {
        $passenger->registrations()->delete();
        $passenger->delete();

        return back();
    }
}
