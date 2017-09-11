<?php

namespace App\Console;

use Illuminate\Support\Facades\Mail;
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
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        $schedule->command('crawl https://ingatlan.com/lista/kiado+lakas+i-ker+ii-ker+xi-ker+xii-ker+havi-100-150-ezer-Ft+3-szoba-felett')->hourly();

        $schedule->call(function () {
            
            Mail::to('bery08@gmail.com')->send(new \App\Mail\AdvertsReport());

        })->dailyAt(19);
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
