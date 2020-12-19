<?php

namespace App\Console;

use App\Console\Commands\RabotaMdParsingCommand;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        //
        RabotaMdParsingCommand::class,
    ];

    /**
     * Define the application's command schedule.
     *
     * @param \Illuminate\Console\Scheduling\Schedule $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        $schedule->command('rabota-md:parse-jobs')
            ->dailyAt('9:00')
            ->pingBefore(config('rabota-md.all_vacansies_url'))
            ->sendOutputTo('storage/logs/rabota-md');
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__ . '/Commands');

        require base_path('routes/console.php');
    }


    public function scheduleTimezone(): string
    {
        return 'Europe/Chisinau';
    }
}
