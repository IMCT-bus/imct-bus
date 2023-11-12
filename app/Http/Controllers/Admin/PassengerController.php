<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\BaseController;
use App\Http\Requests\PassengerRequest;
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

    public function store(PassengerRequest $request): RedirectResponse
    {
        $validated = $request->validated();

        Passenger::create($validated);

        return back();
    }

    public function destroy(Passenger $passenger): RedirectResponse
    {
        $passenger->delete();

        return back();
    }
}
