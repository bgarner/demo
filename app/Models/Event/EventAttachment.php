<?php

namespace App\Models\Event;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class EventAttachment extends Model
{
    use SoftDeletes;
    protected $table = 'event_attachments';
    protected $fillables = ['event_id', 'attachment_id'];
    
}
