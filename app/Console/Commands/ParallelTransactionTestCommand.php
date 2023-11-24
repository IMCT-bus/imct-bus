<?php

namespace App\Console\Commands;

use App\Services\RegistrationService;
use Illuminate\Console\Command;

class ParallelTransactionTestCommand extends Command
{
    protected $signature = 'parallel-transaction:test {tripUuid} {passengerId} {telegram} {stopId}';

    protected $description = 'Run parallel transaction test';

    public function handle(): void
    {
        $tripUuid = $this->argument('tripUuid');
        $passengerId = $this->argument('passengerId');
        $telegram = $this->argument('telegram');
        $stopId = $this->argument('stopId');

        app(RegistrationService::class)->startTransaction($tripUuid, $passengerId, $telegram, $stopId);
    }
}
