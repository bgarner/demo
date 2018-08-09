<?php

namespace App\Listeners;

use App\Events\RawAnalyticsUpdated;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class UpdateResourceAnalytics
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  RawAnalyticsUpdated  $event
     * @return void
     */
    public function handle(RawAnalyticsUpdated $event)
    {
        \Log::info('Coming from listener');
        \Log::info($event->analytics);
        \Log::info('***********');
        
    }
}
