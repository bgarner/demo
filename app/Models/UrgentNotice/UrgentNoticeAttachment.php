<?php

namespace App\Models\UrgentNotice;

use Illuminate\Database\Eloquent\Model;
use App\Models\UrgentNotice\UrgentNoticeAttachmentType;

class UrgentNoticeAttachment extends Model
{
    protected $table = 'urgent_notice_attachment';
    protected $fillable = ['urgent_notice_id' , 'attachment_id'];

    public static function deleteAttachment($attachment_id, $attachment_type)
    {
    	$attachmentTypeId = UrgentNoticeAttachmentType::where('name', $attachment_type)->first()->id;

    	$urgentNoticeAttachmentRecordIds  = UrgentNoticeAttachment::join('urgent_notices', 'urgent_notice_attachment.urgent_notice_id', '=', 'urgent_notices.id')
    										->where('urgent_notice_attachment.attachment_id', $attachment_id)
    										->where('urgent_notices.attachment_type_id', $attachmentTypeId)
    										->select('urgent_notice_attachment.*')	
    										->get();

   		foreach ($urgentNoticeAttachmentRecordIds as $record) {
   			
   			UrgentNoticeAttachment::find($record->id)->delete();
   		}

   		return ;
    }
}
