<?php

namespace Tests\Browser;

use App\Models\Passenger;
use App\Models\Trip;
use App\Services\RegistrationService;
use Database\Seeders\RouteSeeder;
use Database\Seeders\StopSeeder;
use Illuminate\Support\Facades\Artisan;
use Tests\DuskTestCase;

class TransactionTest extends DuskTestCase
{
    protected Trip $trip;

    protected function setUp(): void
    {
        parent::setUp();
        $this->seed(StopSeeder::class);
        $this->seed(RouteSeeder::class);
        Passenger::factory(2)->create();

        $this->trip = Trip::factory()->create([
            'is_published' => true,
            'seats' => 1,
        ]);
    }

    public function test_two_parallel_transactions()
    {
        $tripUuid = $this->trip->uuid;
        $telegram = 'telegram';
        $stopId = (int)$this->trip->route->stops->pluck('id')->first();

        $this->runParallelTransaction($tripUuid, 1, $telegram, $stopId);

        app(RegistrationService::class)->startTransaction(
            $tripUuid,
            2,
            $telegram,
            $stopId
        );
    }

    protected function runParallelTransaction($tripUuid, $passengerId, $telegram, $stopId): void
    {
        $command = sprintf(
            'php artisan parallel-transaction:test "%s" "%s" "%s" "%s"',
            $tripUuid,
            $passengerId,
            $telegram,
            $stopId
        );

        exec($command, $output, $resultCode);

        $this->assertEquals(0, $resultCode, 'Parallel transaction failed: ' . implode(PHP_EOL, $output));
    }

    public function tearDown(): void
    {
        Artisan::call('migrate:refresh');
        parent::tearDown();
    }
}