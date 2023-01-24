<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{

    protected function schedule(Schedule $schedule)
    {
        $schedule->command('backup:run --only-db')->dailyAt('4:00')->timezone('Europe/Madrid');
        //weekly backups
        $schedule->command('backup:run --only-db')->weekly()->mondays()->at('4:05')->timezone('Europe/Madrid');

        //monthly backups
        $schedule->command('backup:run --only-db')->monthly()->tuesdays()->at('4:10')->timezone('Europe/Madrid');

        //yearly backups
        $schedule->command('backup:run --only-db')->yearly()->wednesdays()->at('4:15')->timezone('Europe/Madrid');
        
        $schedule->command('backup:clean')->daily()->at('4:20')->timezone('Europe/Madrid');
    }

    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
