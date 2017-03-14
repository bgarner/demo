<?php

namespace App\Models\Feature;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Document\Document;
use App\Models\Utility\Utility;
use Carbon\Carbon;

class FeatureDocument extends Model
{
    use SoftDeletes;
    protected $table  = 'feature_document';
    protected $fillable = ['document_id', 'feature_id'];
    protected $dates = ['deleted_at'];

    public static function getFeaturedDocuments($feature_id, $store_number)
    {

    	$now = Carbon::now()->toDatetimeString();
    	$featuredDocuments = FeatureDocument::join('documents', 'feature_document.document_id', '=', 'documents.id')
                                ->join('document_target', 'document_target.document_id', '=', 'documents.id')
    							->where('feature_id', $feature_id)
    							->where('documents.start', '<=', $now )
	                            ->where(function($query) use ($now) {
	                                $query->where('documents.end', '>=', $now)
	                                    ->orWhere('documents.end', '=', '0000-00-00 00:00:00' );
	                            })
                                ->where('document_target.store_id', $store_number)
                                ->where('document_target.deleted_at', null)
    							->select('documents.*')
    							->get()
    							->each(function($doc){

    								$doc->folder_path   = Document::getFolderPathForDocument($doc->id);
            						$doc->link          = Utility::getModalLink($doc->filename, $doc->title, $doc->original_extension, $doc->id, 0);
            						$doc->link_with_icon= Utility::getModalLink($doc->filename, $doc->title, $doc->original_extension, $doc->id, 1);
            						$doc->icon          = Utility::getIcon($doc->original_extension);
            						$doc->prettyDate = Utility::prettifyDate($doc->updated_at);
            						$doc->since = Utility::getTimePastSinceDate($doc->updated_at);

    							});
    	return $featuredDocuments;
    }

    public static function getFeaturedDocumentArray($feature_id, $store_number)
    {
        return self::join('document_target', 'document_target.document_id', '=', 'feature_document.document_id')
                                ->where('feature_id', $feature_id)
                                ->where('document_target.store_id', $store_number)
                                ->where('document_target.deleted_at', null)
                                ->get()->pluck('document_id')->toArray();
    }


}
