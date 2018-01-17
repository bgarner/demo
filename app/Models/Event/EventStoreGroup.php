<?php

namespace App\Models\Event;

use Illuminate\Database\Eloquent\Model;

class EventStoreGroup extends Model
{
    protected $table = 'event_store_groups';
    protected $fillable = ['event_id', 'store_group_id'];

}
