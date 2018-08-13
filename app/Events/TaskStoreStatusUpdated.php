<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use App\Models\Task\TaskStoreStatus;

class TaskStoreStatusUpdated
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $analytics;
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(TaskStoreStatus $taskStoreStatus)
    {
        $this->analytics = $taskStoreStatus;
    }

}
