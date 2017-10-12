<?php

namespace App\Models\Event;

use Illuminate\Database\Eloquent\Model;

class EventBanner extends Model
{
    protected $table = 'event_banner';
    protected $fillable = ['event_id', 'banner_id'];
}
