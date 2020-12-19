<?php
declare(strict_types=1);

namespace App\Jobs;

use App\Services\JobsMonitoringApi\RabotaMdService;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class GetRabotaMdVacansies implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public int $tries = 3;

    public int $timeout = 120;

    public function __construct(public RabotaMdService $rabotaMdService)
    {
    }

    public function handle(): void
    {
        $this->rabotaMdService->handle();
    }
}
