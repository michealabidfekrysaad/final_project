<?php

namespace App\Console\Commands;

use App\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class Usertrick extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'ban:userForMonth';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Ban for User who created 3 or more items or reports';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {

        $resultsForReports = DB::table("reports")->whereDate("created_at", "=", now())->get()->groupBy("user_id");
        $resultsForItems = DB::table("items")->whereDate("created_at", "=", now())->get()->groupBy("user_id");
        foreach ($resultsForReports as $user => $reports) {
            if (count($reports) >= 3) {
                User::find($user)->bans()->create([
                    'expired_at' => '+1 month'
                ]);
            }
        }
        foreach ($resultsForItems as $user => $items) {
            if (count($items) >= 3) {
                User::find($user)->bans()->create([
                    'expired_at' => '+1 month'
                ]);
            }
        }
    }
}
