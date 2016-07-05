<?php

namespace App\Models\UrgentNotice;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Utility\Utility;

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

    public static function getDocuments($urgent_notice_id)
    {
        $documents = UrgentNoticeDocument::join('documents', 'documents.id', '=' , 'urgent_notice_documents.document_id')
                            ->where('urgent_notice_documents.urgent_notice_id', $urgent_notice_id)
                            ->select('documents.*')
                            ->get()
                            ->each(function($document){
                                $document->link = Utility::getModalLink($document->filename, $document->title, $document->original_extension, $document->id, 0);
                                $document->link_with_icon = Utility::getModalLink($document->filename, $document->title, $document->original_extension, $document->id, 1);
                                $document->anchor_only =  Utility::getModalLink($document->filename, $document->title, $document->original_extension, $document->id, 1, 1);
                                $document->icon = Utility::getIcon($document->original_extension);
                                $document->since = Utility::getTimePastSinceDate($document->updated_at);
                                $document->prettyDate =  Utility::prettifyDate($document->updated_at);
                            });

        return $documents;
    }

    public static function deleteDocument($document_id)
    {
        UrgentNoticeDocument::where('document_id', $document_id)->delete();    
    }
}
