<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        //$schedule->command('test:prueba')->everyMinute();
        $schedule->command('notificationWhatsApp:activateSystem')->weekdays()->dailyAt('10:00');
        $schedule->command('notificationWhatsApp:dailyProspects')->weekdays()->dailyAt('22:00');
        $schedule->command('notificationWhatsApp:weeklyProspects')->weeklyOn(5, '22:01');
        $schedule->command('notificationWhatsApp:monthlyProspects')->lastDayOfMonth('22:02');
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
