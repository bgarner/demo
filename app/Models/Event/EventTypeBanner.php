<?php

namespace App\Models\Event;

use Illuminate\Database\Eloquent\Model;

class EventTypeBanner extends Model
{
    protected $table = 'event_type_banner';
    protected $fillable = ['event_type_id', 'banner_id'];
}
