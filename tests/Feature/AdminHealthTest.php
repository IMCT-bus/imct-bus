<?php

namespace Tests\Feature;

use App\Models\User;

class AdminHealthTest extends HealthTest
{
    protected function setUp(): void
    {
        parent::setUp();
        $this->actingAs(User::factory()->create());
    }

    public function test_application_returns_successful_response(): void
    {
        $response = $this->get('/');

        $response->assertStatus(302);
        $response->assertRedirect(route('trips.index'));
        $this->followRedirects($response)->assertSuccessful();
    }

    public function test_login_page_returns_redirect_response(): void
    {
        $response = $this->get(route('admin.login.index'));

        $response->assertStatus(302);
        $response->assertRedirect(route('admin.trips.index'));
        $this->followRedirects($response)->assertSuccessful();
    }

    public function test_trips_pages_return_successful_responses(): void
    {
        $this->checkRoute('trips.index');
        $this->checkRoute('trips.showCancel');
        $this->checkRoute('trips.showRegister', ['trip' => $this->trip->uuid]);
    }

    public function test_admin_routes_pages_return_successful_responses(): void
    {
        $this->checkRoute('admin.routes.index');
        $this->checkRoute('admin.routes.create');
        $this->checkRoute('admin.routes.edit', ['route' => $this->route->id]);
    }

    public function test_admin_trips_pages_return_successful_responses(): void
    {
        $this->checkRoute('admin.trips.index');
        $this->checkRoute('admin.trips.show', ['trip' => $this->trip->uuid]);
        $this->checkRoute('admin.trips.create');
        $this->checkRoute('admin.trips.edit', ['trip' => $this->trip->uuid]);
    }

    public function test_admin_passengers_page_returns_successful_response(): void
    {
        $this->checkRoute('admin.passengers.index');
    }

}
