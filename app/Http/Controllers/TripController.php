<?php

namespace App\Http\Controllers;

use App\Http\Requests\CancellationRequest;
use App\Http\Requests\RegistrationRequest;
use App\Http\Resources\TripResource;
use App\Models\Trip;
use App\Services\RegistrationService;
use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\Validation\ValidationException;
use Inertia\Response;

class TripController extends BaseController
{
    public function __construct(private readonly RegistrationService $registrationService) {}

    public function index(): Response
    {
        $trips = TripResource::collection(
            Trip::with('route')
                ->withCount('registrations')
                ->published()
                ->todayAndLaterButSkipTodayAfterTwoHoursFromStartsAt()
                ->orderByStartsAt()
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

    public function register(RegistrationRequest $request, Trip $trip): RedirectResponse
    {
        $validated = $request->validated();

        try {
            $this->registrationService->create($validated, $trip);
            return redirect()->route('trips.index');
        } catch (ValidationException $exception) {
            return back()->withErrors($exception->validator->errors());
        } catch (Exception $exception) {
            return back()->withErrors(['transactionError' => $exception->getMessage()]);
        }
    }

    public function showCancel(): Response
    {
        return inertia('Trips/Cancel', [
            'trips' => TripResource::collection(
                Trip::with('route')
                ->published()
                ->todayAndLater()
                ->orderByStartsAt()
                ->get()
            )
        ]);
    }

    public function cancel(CancellationRequest $request, Trip $trip): RedirectResponse
    {
        $validated = $request->validated();

        try {
            $this->registrationService->destroy($validated, $trip);
            return redirect()->route('trips.index');
        } catch (ValidationException $exception) {
            return back()->withErrors($exception->validator->errors());
        }
    }

}
