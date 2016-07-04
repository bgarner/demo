<?php

namespace App\Models\UrgentNotice;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class UrgentNoticeDocument extends Model
{
    use SoftDeletes;

    protected $table = 'urgent_notice_documents';
    protected $fillable = ['urgent_notice_id' , 'document_id'];
	protected $dates = ['deleted_at'];    

	public static function updateDocuments($documents, $urgent_notice_id)
    {
        UrgentNoticeDocument::where('urgent_notice_id', $urgent_notice_id)->delete();
        foreach ($documents as $document) {
            UrgentNoticeDocument::create([
                'urgent_notice_id' => $urgent_notice_id,
                'document_id' => $document
            ]);
        } 
    }
}
