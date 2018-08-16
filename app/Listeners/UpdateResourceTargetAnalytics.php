<?php

namespace App\Listeners;

use App\Events\ResouceTargetUpdated;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class UpdateResourceTargetAnalytics
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
     * @param  ResouceTargetUpdated  $event
     * @return void
     */
    public function handle(ResouceTargetUpdated $event)
    {
        //
    }
}
