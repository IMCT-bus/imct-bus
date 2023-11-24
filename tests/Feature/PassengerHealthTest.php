<?php

namespace Tests\Feature;

class PassengerHealthTest extends HealthTest
{
    private function checkAdminRoute($route, $parameters = []): void
    {
        $response = $this->get(route($route, $parameters));
        $response->assertStatus(302);
        $response->assertRedirect(route('admin.login.index'));
        $this->followRedirects($response)->assertSuccessful();
    }


    public function test_application_returns_successful_response(): void
    {
        $response = $this->get('/');

        $response->assertStatus(302);
        $response->assertRedirect(route('trips.index'));
        $this->followRedirects($response)->assertSuccessful();
    }

    public function test_login_page_returns_successful_response(): void
    {
        $this->checkRoute('admin.login.index');
    }

    public function test_trips_pages_return_successful_responses(): void
    {
        $this->checkRoute('trips.index');
        $this->checkRoute('trips.showCancel');
        $this->checkRoute('trips.showRegister', ['trip' => $this->trip->uuid]);
    }

    public function test_admin_routes_pages_return_redirect_responses(): void
    {
        $this->checkAdminRoute('admin.routes.index');
        $this->checkAdminRoute('admin.routes.create');
        $this->checkAdminRoute('admin.routes.edit', ['route' => $this->route->id]);
    }

    public function test_admin_trips_pages_return_redirect_responses(): void
    {
        $this->checkAdminRoute('admin.trips.index');
        $this->checkAdminRoute('admin.trips.show', ['trip' => $this->trip->uuid]);
        $this->checkAdminRoute('admin.trips.create');
        $this->checkAdminRoute('admin.trips.edit', ['trip' => $this->trip->uuid]);
    }

    public function test_admin_passengers_page_returns_redirect_response(): void
    {
        $this->checkAdminRoute('admin.passengers.index');
    }

}
