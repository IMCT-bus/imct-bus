<?php

namespace Tests\Feature;

use App\Models\Route;
use App\Models\Trip;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class HealthTest extends TestCase
{
    use RefreshDatabase;

    protected Route $route;
    protected Trip $trip;

    protected function setUp(): void
    {
        parent::setUp();
        $this->route = Route::factory()->create();
        $this->trip = Trip::factory()->create();
    }

    protected function checkRoute($route, $parameters = []): void
    {
        $response = $this->get(route($route, $parameters));
        $response->assertSuccessful();
    }
}

