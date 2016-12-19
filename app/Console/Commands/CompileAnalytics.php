<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Foundation\Inspiring;
use App\Models\Analytics\Analytics;
use Carbon\Carbon;


class CompileAnalytics extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'CompileAnalytics';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Compiles the analytics for the last hour';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
            $traffic24hrs = Analytics::getTrafficLast24hrs();
            $traffic30days = Analytics::getTrafficLast30Days();
            $communicationStats = Analytics::getCommunicationStats();
            $urgentNoticeStats = Analytics::getUrgentNoticeStats();

            $targetFiles = [ 'traffic24hrs', 'traffic30days', 'communicationStats', 'urgentNoticeStats'];
            foreach ($targetFiles as $target) {
                $analyticsFile = storage_path() . "/analytics/" . $target . ".json";
                $targetData = $$target;
                file_put_contents($analyticsFile , $targetData );    
            }
            
    }
}
