<?php
declare(strict_types=1);

namespace App\Console\Commands;

use App\Jobs\GetRabotaMdVacansies;
use App\Services\JobsMonitoringApi\RabotaMdService;
use Illuminate\Console\Command;

class RabotaMdParsingCommand extends Command
{
    protected $signature = 'rabota-md:parse-jobs';

    protected $description = 'Parse jobs from Rabota.md';


    public function __construct(public RabotaMdService $rabotaMdService)
    {
        parent::__construct();
    }

    public function handle(): int
    {
        dispatch(new GetRabotaMdVacansies($this->rabotaMdService));

        return 0;
    }
}
