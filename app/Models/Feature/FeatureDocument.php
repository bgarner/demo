<?php

namespace App\Models\Feature;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Document\Document;
use App\Models\Utility\Utility;
use App\Models\StoreApi\StoreInfo;
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
        $banner_id = StoreInfo::getStoreInfoByStoreId($store_number)->banner_id;

        $targetedFeatureDocuments = FeatureDocument::join('documents', 'documents.id', '=',     'feature_document.document_id')
                                ->join('document_target', 'document_target.document_id', '=', 'documents.id')
                                ->where('feature_id', $feature_id)
                                ->where('documents.start', '<=', $now )
                                ->where(function($query) use ($now) {
                                    $query->where('documents.end', '>=', $now)
                                        ->orWhere('documents.end', '=', '0000-00-00 00:00:00' )
                                        ->orWhere('documents.end', '=', NULL );
                                })
                                ->where('document_target.store_id', $store_number)
                                // ->where('document_target.deleted_at', null)
                                ->select('documents.*')
                                ->get();

        $allStoreFeatureDocuments = FeatureDocument::join('documents', 'documents.id', '=',     'feature_document.document_id')
                                    ->where('documents.all_stores', 1)
                                    ->where('documents.banner_id', $banner_id)
                                    ->where('feature_id', $feature_id)
                                    ->where('documents.start', '<=', $now )
                                    ->where(function($query) use ($now) {
                                        $query->where('documents.end', '>=', $now)
                                            ->orWhere('documents.end', '=', '0000-00-00 00:00:00' )
                                            ->orWhere('documents.end', '=', NULL );
                                    })
                                    // ->where('document_target.store_id', $store_number)
                                    ->select('documents.*')
                                    ->get();

        $featuredDocuments = $targetedFeatureDocuments->merge($allStoreFeatureDocuments)
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



    public static function getFeaturedDocumentsByStoreList($storesByBanner, $storeGroups, $feature_id)
    {

        $now = Carbon::now()->toDatetimeString();
        $storeNumbersArray = $storesByBanner->flatten()->toArray();

        $targetedFeatureDocuments = FeatureDocument::join('documents', 'documents.id', '=',     'feature_document.document_id')
                                ->join('document_target', 'document_target.document_id', '=', 'documents.id')
                                ->where('feature_id', $feature_id)
                                ->where('documents.start', '<=', $now )
                                ->where(function($query) use ($now) {
                                    $query->where('documents.end', '>=', $now)
                                        ->orWhere('documents.end', '=', '0000-00-00 00:00:00' )
                                        ->orWhere('documents.end', '=', NULL );
                                })
                                ->whereIn('document_target.store_id', $storeNumbersArray)
                                ->select('documents.*')
                                ->get();

        $allStoreFeatureDocuments = FeatureDocument::join('documents', 'documents.id', '=',     'feature_document.document_id')
                                    ->where('documents.all_stores', 1)
                                    ->whereIn('documents.banner_id', $storesByBanner->keys())
                                    ->where('feature_id', $feature_id)
                                    ->where('documents.start', '<=', $now )
                                    ->where(function($query) use ($now) {
                                        $query->where('documents.end', '>=', $now)
                                            ->orWhere('documents.end', '=', '0000-00-00 00:00:00' )
                                            ->orWhere('documents.end', '=', NULL );
                                    })
                                    // ->where('document_target.store_id', $store_number)
                                    ->select('documents.*')
                                    ->get();

        $featuredDocuments = $targetedFeatureDocuments->merge($allStoreFeatureDocuments)
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
        return Self::join('document_target', 'document_target.document_id', '=', 'feature_document.document_id')
                                ->where('feature_id', $feature_id)
                                ->where('document_target.store_id', $store_number)
                                ->get()->pluck('document_id')->toArray();
    }

    public static function getDocumentByFeatureId($id)
    {
        $feature_documents = FeatureDocument::where('feature_id', $id)->get()->pluck('document_id');
        $selected_documents  = array();
        foreach ($feature_documents as $doc_id) {
            $doc              = Document::find($doc_id);
            $doc->folder_path = Document::getFolderPathForDocument($doc_id);
            $doc->link_with_icon = Utility::getModalLink($doc->filename, $doc->title, $doc->original_extension, $doc->id, 1);
            array_push($selected_documents, $doc );
            
        }
        return $selected_documents;    
    }
    


}
