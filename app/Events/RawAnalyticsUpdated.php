<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use App\Models\Analytics\Analytics;

class RawAnalyticsUpdated
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $analytics;
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(Analytics $analytics)
    {
        $this->analytics = $analytics;
    }

    
}
