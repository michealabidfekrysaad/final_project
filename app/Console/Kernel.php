<?php

namespace App\Console;

use App\User;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use Illuminate\Support\Facades\DB;

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
        $schedule->call(function () {

            $resultsForReports= DB::table("reports")->whereDate("created_at","=",now())->get()->groupBy("user_id");
            $resultsForItems= DB::table("items")->whereDate("created_at","=",now())->get()->groupBy("user_id");
            foreach ($resultsForReports as $user => $reports){
                if (count($reports)>=3){
                    User::find($user)->bans()->create([
                        'expired_at' => '+1 month'
                    ]);
                }
            }
            foreach ($resultsForItems as $user => $items){
                if (count($items)>=3){
                    User::find($user)->bans()->create([
                        'expired_at' => '+1 month'
                    ]);
                }
            }
        })->daily();
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
