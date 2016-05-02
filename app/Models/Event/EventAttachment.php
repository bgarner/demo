<?php

namespace App\Models\Event;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class EventAttachment extends Model
{
    use SoftDeletes;
    protected $table = 'event_attachments';
    protected $fillable = ['event_id', 'attachment_id'];

    public static function updateAttachments($id, $request)
    {
    	EventAttachment::where('event_id', $id)->delete();
    	
    	$attachments = $request['attachments'];
    	if (isset($attachments)) {
    		foreach ($attachments as $attachment) {
	    		EventAttachment::create([
	    			'event_id' => $id,
	    			'attachment_id' => $attachment

	    		]);
    		}
    	}
    	
    	return;
    }
    
}
