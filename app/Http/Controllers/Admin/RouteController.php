<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\BaseController;
use App\Models\Route;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Inertia\Response;

class RouteController extends BaseController
{
    public function index(): Response
    {
        return inertia('Routes/Index', [
            'routes' => Route::with('stops')
        ]);
    }

    public function show(Route $route): Response
    {
        return inertia('Admin/Routes/Show', [
            'route' => $route->load('stops')
        ]);
    }

    public function create(): Response
    {
        return inertia('Admin/Routes/Create');
    }

    public function store(Request $request): RedirectResponse
    {
        $routeId = Route::create($request->validated());

        return redirect()->route('admin.routes.show', $routeId);
    }

    public function edit(Route $route): Response
    {
        return inertia('Admin/Routes/Edit', [
            'route' => $route->load('stops')
        ]);
    }

    public function update(Request $request, Route $route): RedirectResponse
    {
        $route->update($request->validated());

        return redirect()->route('admin.routes.show', $route->id);
    }

    public function destroy(Route $route): RedirectResponse
    {
        $route->delete();

        return redirect()->route('admin.routes.index');
    }
}