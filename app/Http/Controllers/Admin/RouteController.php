<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\BaseController;
use App\Http\Requests\RouteRequest;
use App\Http\Resources\RouteResource;
use App\Models\Route;
use App\Services\RouteService;
use Illuminate\Http\RedirectResponse;
use Inertia\Response;

class RouteController extends BaseController
{
    public function __construct(private readonly RouteService $routeService){}

    public function index(): Response
    {
        $routes = RouteResource::collection(
            Route::with('stops')->orderBy('starts_at')->get()
        );

        return inertia('Admin/Routes/Index', ['routes' => $routes]);
    }

    public function create(): Response
    {
        return inertia('Admin/Routes/Create');
    }

    public function store(RouteRequest $request): RedirectResponse
    {
        $validated = $request->validated();

        $this->routeService->create($validated);

        return redirect()->route('admin.routes.index');
    }

    public function edit(Route $route): Response
    {
        return inertia('Admin/Routes/Edit', [
            'route' => new RouteResource($route->load('stops'))
        ]);
    }

    public function update(RouteRequest $request, Route $route): RedirectResponse
    {
        $validated = $request->validated();

        $this->routeService->update($validated, $route);

        return redirect()->route('admin.routes.index');
    }

    public function destroy(Route $route): RedirectResponse
    {
        $route->delete();

        return redirect()->route('admin.routes.index');
    }
}
