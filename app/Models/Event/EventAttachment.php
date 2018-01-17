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
    	$attachments = $request['attachments'];
        $remove_attachments = $request['remove_attachments'];
    	if (isset($attachments)) {
    	   EventAttachment::addAttachments($attachments, $id);
    	}
        if (isset($remove_attachments) && count($remove_attachments) >0) {
            EventAttachment::removeAttachments($remove_attachments, $id);
        }

    	
    	return;

    }

    public static function addAttachments($attachments, $event_id)
    {
        
        foreach ($attachments as $attachment) {
             EventAttachment::create([
                 'event_id' => $event_id,
                 'attachment_id' => $attachment

             ]);
         }
        return;
    }

    public static function removeAttachments($attachments, $event_id)
    {
        
        foreach ($attachments as $attachment) {
            EventAttachment::where('event_id', $event_id)->where('attachment_id', intval($attachment))->delete();  
        }
        
        return;
    }

    public static function getEventAttachments($id)
    {
        $event_attachment_ids = EventAttachment::where('event_id', $id)->where('deleted_at', null)->get()->pluck('attachment_id');
        
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
