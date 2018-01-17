<?php

namespace App\Models\Notification;

use Illuminate\Database\Eloquent\Model;
use App\Models\Document\Document;
use App\Models\Feature\Feature;
use Carbon\Carbon;
use Log;
use DB;
use App\Models\Utility\Utility;

class Notification extends Model
{
    public static function getAllNotifications($bannerId, $storeNumber, $windowType, $windowSize)
    {

        
    	switch($windowType){
    		case 1:  //number of days

                $notifications = Self::getNotificationsByStoreAndNumberOfDays($bannerId, $storeNumber, $windowSize);
                $allStoreNotifications  = Self::getNotificationsForAllStoresByNumberOfDays($bannerId, $windowSize);

                $notifications = $notifications->merge($allStoreNotifications)->sortByDesc('updated_at');
                break;

    		case 2:  // number of Documents

                $notifications = Self::getNotificationsByStoreAndNumberOfDocuments($bannerId, $storeNumber);
                $allStoreNotifications = Self::getNotificationsForAllStoresByNumberOfDocuments($bannerId);
                $notifications = $notifications->merge($allStoreNotifications)->sortByDesc('updated_at')->take($windowSize);
    			break;

    		default:
                $notifications = [];
    			break;
    	}

        if( count($notifications) > 0){
            Notification::prettifyNotifications($notifications);

            foreach($notifications as $n){

                $n->icon = Utility::getIcon($n->original_extension);
                $n->link = Utility::getModalLink($n->filename, $n->title, $n->original_extension, $n->id, 0);
                $n->link_with_icon = Utility::getModalLink($n->filename, $n->title, $n->original_extension, $n->id, 1);
                $n->linkedIcon = Utility::getModalLink($n->filename, $n->icon, $n->original_extension, $n->id, 0);
                
            }    
        }
    
    	return $notifications;
    }

    public static function getNotificationsByFeature($featureId, $storeNumber)
    {
        $feature = Feature::find($featureId);
        $windowType = $feature->update_type_id;
        $windowSize = $feature->update_frequency;
        $now = Carbon::now()->toDatetimeString();

        $documentIdArray = Feature::getDocumentsIdsByFeatureId($featureId, $storeNumber);
        $documentIdArray = array_values($documentIdArray);

        switch($windowType){
            case 1:  //by number of days
                $dateSince = Carbon::now()->subDays($windowSize)->toDateTimeString();
                $notifications = Document::whereIn('id', $documentIdArray)
	                    ->orderBy('updated_at', 'desc')
	                    ->where('start', '<=', $now)
	                    ->where(function($query) use ($now) {
	                        $query->where('documents.end', '>=', $now)
	                            ->orWhere('documents.end', '=', '0000-00-00 00:00:00' )
                                ->orWhere('documents.end', '=', NULL); 
	                    })
	                    ->groupBy('documents.upload_package_id')
	                    ->select('documents.*', DB::raw('count(*) as count'))
	                    ->get();
                $i=0;
                foreach($notifications as $n){
                    if($n->updated_at < $dateSince){
                        $notifications->forget($i);
                    }
                    $i++;
                }
                
                break;
            case 2:  //by number of documents
                $notifications = Document::whereIn('id', $documentIdArray)
	                    ->orderBy('updated_at', 'desc')
	                    ->where('start', '<=', $now)
	                    ->where(function($query) use ($now) {
	                        $query->where('documents.end', '>=', $now)
	                            ->orWhere('documents.end', '=', '0000-00-00 00:00:00' )
                                ->orWhere('documents.end', '=', NULL); 
	                    })
	                    ->groupBy('documents.upload_package_id')
	                    ->select('documents.*', DB::raw('count(*) as count'))
	                    ->take($windowSize)
	                    ->get();
                break;

            default:
                $notifications ="not a valid parameter in getAllNotifications()";
                break;
        }

        Notification::prettifyNotifications($notifications);
        foreach($notifications as $n){

            $n->link = Utility::getModalLink($n->filename, $n->title, $n->original_extension, $n->id, 0);
            $n->link_with_icon = Utility::getModalLink($n->filename, $n->title, $n->original_extension, $n->id, 1);
            $n->icon = Utility::getIcon($n->original_extension);
            $n->linkedIcon = Utility::getModalLink($n->filename, $n->icon, $n->original_extension, $n->id, 0);

        }

        return $notifications;
    }

    public static function prettifyNotifications($notifications)
    {
       foreach($notifications as $n){
            //get folder info for the doc
            $folder_info = Document::getFolderInfoByDocumentId($n->id);
            $n->folder_name = $folder_info->name;
            $n->global_folder_id = $folder_info->global_folder_id;

            // get the human readable days since 
            $n->since =  Utility::getTimePastSinceDate($n->start);

            //adjust the verbage
            if( $n->created_at == $n->updated_at ){
                $n->verb = "added to";
            } else {
                $n->verb = "updated in";
            }            
            
            //make the timestamp on the file a little nicer
            $n->prettyDate =  Utility::prettifyDate($n->start);
        }
        return $notifications;
    }

    public static function getNotificationsByStoreAndNumberOfDays($bannerId, $storeNumber, $windowSize)
    {
        $now = Carbon::now()->toDatetimeString();
        $dateSince = Carbon::now()->subDays($windowSize)->toDateTimeString();
        return Document::where('banner_id', $bannerId)
                        ->join('document_target', 'document_target.document_id', '=', 'documents.id')
                        ->where('documents.updated_at', '>=', $dateSince)
                        ->where('start', '<=', $now)
                        ->where(function($query) use ($now) {
                            $query->where('documents.end', '>=', $now)
                                ->orWhere('documents.end', '=', '0000-00-00 00:00:00' )
                                ->orWhere('documents.end', '=', NULL); 
                        })
                        ->where('document_target.store_id', '=', $storeNumber)
                        ->orderBy('documents.start', 'desc')
                        ->select('documents.*', DB::raw('count(*) as count'))
                        ->groupBy('documents.upload_package_id')
                        ->get(); 
    }

    public static function getNotificationsForAllStoresByNumberOfDays($bannerId, $windowSize)
    {
        $now = Carbon::now()->toDatetimeString();
        $dateSince = Carbon::now()->subDays($windowSize)->toDateTimeString();
        return  Document::where('banner_id', $bannerId)
                        ->where('documents.updated_at', '>=', $dateSince)
                        ->where('start', '<=', $now)
                        ->where(function($query) use ($now) {
                            $query->where('documents.end', '>=', $now)
                                ->orWhere('documents.end', '=', '0000-00-00 00:00:00' )
                                ->orWhere('documents.end', '=', NULL); 
                        })
                        ->where('all_stores' , 1)
                        ->orderBy('documents.updated_at', 'desc')
                        ->select('documents.*', DB::raw('count(*) as count'))
                        ->groupBy('documents.upload_package_id')
                        ->get(); 

    }

    public static function getNotificationsByStoreAndNumberOfDocuments($bannerId, $storeNumber)
    {
        $now = Carbon::now()->toDatetimeString();
        return Document::where('banner_id', $bannerId)
                        ->join('document_target', 'document_target.document_id', '=', 'documents.id')
                        ->where('start', '<=', $now)
                        ->where(function($query) use ($now) {
                            $query->where('documents.end', '>=', $now)
                                ->orWhere('documents.end', '=', '0000-00-00 00:00:00' )
                                ->orWhere('documents.end', '=', NULL); 
                        })
                        ->where('document_target.store_id', '=', $storeNumber)
                        ->orderBy('documents.start', 'desc')
                        ->select('documents.*', DB::raw('count(*) as count'))
                        ->groupBy('documents.upload_package_id')
                        ->get();
    }

    public static function getNotificationsForAllStoresByNumberOfDocuments($bannerId)
    {
        $now = Carbon::now()->toDatetimeString();
        return Document::where('banner_id', $bannerId)
                        ->where('start', '<=', $now)
                        ->where(function($query) use ($now) {
                            $query->where('documents.end', '>=', $now)
                                ->orWhere('documents.end', '=', '0000-00-00 00:00:00' )
                                ->orWhere('documents.end', '=', NULL); 
                        })
                        ->where('all_stores', 1)
                        ->orderBy('documents.updated_at', 'desc')
                        ->select('documents.*', DB::raw('count(*) as count'))
                        ->groupBy('documents.upload_package_id')
                        ->get();
    }

}
