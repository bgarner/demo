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

	public static function addDocuments($documents, $urgent_notice_id)
    {
        if(isset($documents) && count($documents)>0) {
            foreach ($documents as $document) {
                UrgentNoticeDocument::create([
                    'urgent_notice_id' => $urgent_notice_id,
                    'document_id' => $document
                ]);
            }     
        }
        
    }

    public static function updateDocuments($request, $id)
    {
        $remove_documents = $request['remove_document'];
        if(isset($remove_documents) && count($remove_documents)>0) {
            foreach ($remove_documents as $doc) {
                UrgentNoticeDocument::where('urgent_notice_id', $id)->where('document_id', $doc)->delete();    
            }    
        }
        

        $add_documents = $request['urgentnotice_files'];

        UrgentNoticeDocument::addDocuments($add_documents, $id);
        
    }
}
