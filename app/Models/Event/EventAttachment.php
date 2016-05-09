<?php

namespace App\Models\Event;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Document\Folder;

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

    public static function getEventAttachments($id)
    {
        $event_attachment_ids = EventAttachment::where('event_id', $id)->get()->pluck('attachment_id');
        
        $event_attachments = [];
        foreach ($event_attachment_ids as $attachment_id) {

            $folder = Folder::where('id', $attachment_id)->first();
            $path = Folder::getFolderPath($attachment_id); 
            $folder["folder_path"] = $path;
            $folder["global_folder_id"] = $attachment_id;
            array_push($event_attachments, $folder);
        }
        return ( $event_attachments );
        
    }
    
}
