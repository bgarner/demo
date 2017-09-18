<?php

namespace App\Models\Search;

use Illuminate\Database\Eloquent\Model;
use App\Models\Document\Document;
use App\Models\Document\Folder;
use App\Models\Communication\Communication;
use App\Models\Utility\Utility;
use Carbon\Carbon;
use Log;
use Illuminate\Database\Eloquent\Collection as Collection;
use App\Models\Event\Event;
use App\Models\Event\EventType;
use App\Models\Video\Video;
use App\Models\ProductLaunch\ProductLaunch;
use App\Models\StoreApi\StoreInfo;

class Search extends Model
{
    public static function searchDocuments($query, $store)
    {
    	$docs = collect();
        $allStoreDocs = collect();
    	
    	$query_terms = explode( ' ', $query);

        $today = Carbon::now();

    	foreach ($query_terms as $term) {
    		$docs = $docs->merge(
                        Document::join('document_target', 'document_target.document_id' , '=', 'documents.id' )
                                ->where('title', 'LIKE', '%'.$term.'%')                        
    							->where('start', '<=', $today )
    							->where(function($q) use($today) {
    								$q->where('end', '>=', $today)
    								->orWhere('end', '=', '0000-00-00 00:00:00')
                                    ->orWhere('end', '=', NULL);
    							})
                                ->where('document_target.store_id', $store)
                                ->select('documents.*')
    							->get()
    				);

            $allStoreDocs = $allStoreDocs->merge(
                                    Document::where('all_stores', 1)
                                    ->where('title', 'LIKE', '%'.$term.'%')                        
                                    ->where('start', '<=', $today )
                                    ->where(function($q) use($today) {
                                        $q->where('end', '>=', $today)
                                        ->orWhere('end', '=', '0000-00-00 00:00:00')
                                        ->orWhere('end', '=', NULL);
                                    })
                                    ->select('documents.*')
                                    ->get()
                                    );
            $docs = $docs->merge($allStoreDocs);

    	}
    	

        foreach($docs as $doc){
            $doc->modalLink = Utility::getModalLink($doc->filename, $doc->title, $doc->original_extension, 1, 0);
            $doc->since = Utility::getTimePastSinceDate($doc->updated_at);

            $folder_info = Document::getFolderInfoByDocumentId($doc->id);

            $doc->folder_name = $folder_info->name;
            $doc->global_folder_id = $folder_info->global_folder_id;
            $doc->rank = 1;
            
        }   

        $ranked_results = Search::rankSearchResults($docs);

        $ranked_results = $ranked_results->sortBy(function($sort){
                    return $sort->rank;
                })->reverse();
    	return $ranked_results;
    }

    public static function searchArchivedDocuments($query, $store)
    {
        $docs = collect();
        $allStoreDocs = collect();
        
        $query_terms = explode( ' ', $query);
        
        $today = Carbon::now();
        foreach ($query_terms as $term) {
            $docs = $docs->merge(
                        Document::join('document_target', 'document_target.document_id', '=', 'documents.id' )
                                ->where('title', 'LIKE', '%'.$term.'%')
                                ->where('end', '<=', $today )
                                ->where('end', '!=', '0000-00-00 00:00:00')
                                ->where('end', '!=', NULL)
                                ->where('document_target.store_id', $store)
                                ->select('documents.*')
                                ->get()
                    );     
            $allStoreDocs = $allStoreDocs->merge(
                                    Document::where('all_stores', 1)
                                    ->where('title', 'LIKE', '%'.$term.'%')    
                                    ->where('end', '<=', $today )
                                    ->where('end', '!=', '0000-00-00 00:00:00')                    
                                    ->where('end', '!=', NULL)
                                    ->select('documents.*')
                                    ->get()
                                );
            $docs = $docs->merge($allStoreDocs); 

        }


        foreach($docs as $doc){
            $doc->archived = true;
            $doc->modalLink = Utility::getModalLink($doc->filename, $doc->title, $doc->original_extension, 1, 0);
            $doc->since = Utility::getTimePastSinceDate($doc->updated_at);

            $folder_info = Document::getFolderInfoByDocumentId($doc->id);

            $doc->folder_name = $folder_info->name;
            $doc->global_folder_id = $folder_info->global_folder_id;
            $doc->rank = 1;
        }

        $ranked_results = Search::rankSearchResults($docs);

        $ranked_results = $ranked_results->sortBy(function($sort){
                    return $sort->rank;
                })->reverse();
        return $ranked_results;

    }

    public static function searchFolders($query)
    {
    	$folders = collect();
    	
    	$query_terms = explode( ' ', $query);
    	
    	foreach ($query_terms as $term) {
    		$folders = $folders->merge(
    					Folder::where('name', 'LIKE', '%'.$term.'%')
    							->get()
    				);		

    	}
    	
    	$folders = $folders->sortBy(function($sort){
    		return $sort->updated_at;
		})->reverse();

        foreach($folders as $folder){
            
            $folder->globalId = Folder::getGlobalFolderId($folder->id);
            $folder->lastActivity = Utility::getTimePastSinceDate($folder->last_activity_at);

            $path = Folder::getFolderPath($folder->globalId);
            $pathString = "";

            $i = 1;
            foreach($path as $p){
                if( $i < count($path) ){
                    $pathString .= " ". $p['name'] . " <i class='fa fa-caret-right'></i> "; 
                    
                } else {
                    $pathString .= " ". $p['name'];   
                }
                
                $i++;
            }

            $folder->path = $pathString;
            $folder->rank = 1;
        }

    	
        $ranked_results = Search::rankSearchResults($folders);

        $ranked_results = $ranked_results->sortBy(function($sort){
                    return $sort->rank;
                })->reverse();
        return $ranked_results;
    }

    public static function searchCommunications($query, $store)
    {
    	$communications = collect();
        $allStoreCommunications = collect();
    	
    	$query_terms = explode( ' ', $query);
    	
        $today = Carbon::now();

    	foreach ($query_terms as $term) {
    		$communications = $communications->merge(
    							Communication::join('communications_target', 'communications_target.communication_id', '=', 'communications.id')
    							->where('subject', 'LIKE', '%'.$term.'%')
    							->where('store_id', '=', $store)
    							->where('send_at', '<=', $today )
    							->where(function($q) use($today) {
    								$q->where('archive_at', '>=', $today)
    								->orWhere('archive_at', '=', '0000-00-00 00:00:00');
    							})

    							->get()
    				        );

            $allStoreCommunications = $allStoreCommunications->merge(
                                            Communication::where('subject', 'LIKE', '%'.$term.'%')
                                            ->where('all_stores', 1)
                                            ->where('send_at', '<=', $today )
                                            ->where(function($q) use($today) {
                                                $q->where('archive_at', '>=', $today)
                                                ->orWhere('archive_at', '=', '0000-00-00 00:00:00');
                                            })
                                            ->get()
                                        );
            $communications = $communications->merge($allStoreCommunications);
    	}
    	

        foreach($communications as $comm){
            $comm->since = Utility::getTimePastSinceDate($comm->updated_at);
            $preview_string = strip_tags($comm->body);         
            $comm->trunc = Utility::truncateHtml($preview_string, 150);
            $comm->rank = 1;
        }

        $ranked_results = Search::rankSearchResults($communications);

        $ranked_results = $ranked_results->sortBy(function($sort){
                    return $sort->rank;
                })->reverse();
        return $ranked_results;
    }

    public static function searchArchivedCommunications($query, $store)
    {
        $communications = collect();
        $allStoreCommunications = collect();
        
        $query_terms = explode( ' ', $query);
        
        $today = Carbon::now();
        foreach ($query_terms as $term) {
            $communications = $communications->merge(
                                Communication::join('communications_target', 'communications_target.communication_id', '=', 'communications.id')
                                ->where('subject', 'LIKE', '%'.$term.'%')
                                ->where('store_id', '=', $store)
                                ->where('archive_at', '<=', $today)
                                ->get()
                    );

            $allStoreCommunications = $allStoreCommunications->merge(
                                Communication::where('subject', 'LIKE', '%'.$term.'%')
                                ->where('all_stores', 1)
                                ->where('archive_at', '<=', $today)
                                ->get()
                    );

            $communications = $communications->merge($allStoreCommunications);
        }
        
        foreach($communications as $comm){
            $comm->archived = true;
            $comm->since = Utility::getTimePastSinceDate($comm->updated_at);
            $preview_string = strip_tags($comm->body);         
            $comm->trunc = Utility::truncateHtml($preview_string, 150);
            $comm->rank = 1;
        }

        $ranked_results = Search::rankSearchResults($communications);

        $ranked_results = $ranked_results->sortBy(function($sort){
                    return $sort->rank;
                })->reverse();
        return $ranked_results;
    }

    public static function searchAlerts($query, $store)
    {
    	$alerts = collect();
        $allStoreAlerts = collect();
    	
    	$query_terms = explode( ' ', $query);
    	
    	$today = Carbon::now();
    	foreach ($query_terms as $term) {
    		$alerts = $alerts->merge(
    							Document::join('alerts', 'documents.id', '=', 'alerts.document_id')
                                ->join('document_target', 'alerts.document_id' , '=', 'document_target.document_id')
                                ->where('document_target.store_id', $store)
                                ->where('title', 'LIKE', '%'.$term.'%')
    							->where('documents.start', '<=', $today )
                                ->where(function($query) use ($today) {
                                    $query->where('documents.end', '>=', $today)
                                        ->orWhere('documents.end', '=', '0000-00-00 00:00:00' )
                                        ->orWhere('documents.end', '=', NULL ); 
                                })
    							->get()
    				);

            $allStoreAlerts = $allStoreAlerts->merge(
                                Document::join('alerts', 'documents.id', '=', 'alerts.document_id')
                                ->where('documents.all_stores', 1)
                                ->where('title', 'LIKE', '%'.$term.'%')
                                ->where('documents.start', '<=', $today )
                                ->where(function($query) use ($today) {
                                    $query->where('documents.end', '>=', $today)
                                        ->orWhere('documents.end', '=', '0000-00-00 00:00:00' )
                                        ->orWhere('documents.end', '=', NULL ); 
                                })
                                ->get()
                    );
            $alerts = $alerts->merge($allStoreAlerts);
    	}
    	

        foreach ($alerts as $alert) {
            $alert->modalLink = Utility::getModalLink($alert->filename, $alert->title, $alert->original_extension, 1, 0);
            $alert->since = Utility::getTimePastSinceDate($alert->start);
            $alert->rank = 1;
        }

        $ranked_results = Search::rankSearchResults($alerts);

        $ranked_results = $ranked_results->sortBy(function($sort){
                    return $sort->rank;
                })->reverse();
        return $ranked_results;
    }

    public static function searchArchivedAlerts($query, $store)
    {
        $alerts = collect();
        $allStoreAlerts = collect();
        
        $query_terms = explode( ' ', $query);
        
        //$today = Carbon::now()->toDateString();
        $today = Carbon::now();
        foreach ($query_terms as $term) {

            $alerts = $alerts->merge(
                                Document::join('alerts', 'documents.id', '=', 'alerts.document_id')
                                ->join('document_target', 'alerts.document_id' , '=', 'document_target.document_id')
                                ->where('title', 'LIKE', '%'.$term.'%')      
                                ->where('document_target.store_id', $store)
                                ->where('documents.end', '<=', $today )
                                ->where('documents.end', '!=', '0000-00-00 00:00:00') 
                                ->where('documents.end', '!=', NULL) 
                                ->get()
                    );
            $allStoreAlerts = $allStoreAlerts->merge(
                                    Document::join('alerts', 'documents.id', '=', 'alerts.document_id')
                                    ->where('documents.all_stores', 1)
                                    ->where('title', 'LIKE', '%'.$term.'%')    
                                    ->where('documents.end', '<=', $today )
                                    ->where('documents.end', '!=', '0000-00-00 00:00:00')     
                                    ->where('documents.end', '!=', NULL)                    
                                    ->select('documents.*')
                                    ->get()
                                );
            $alerts = $alerts->merge($allStoreAlerts);
        }
        
        foreach ($alerts as $alert) {
            $alert->archived = true;
            $alert->modalLink = Utility::getModalLink($alert->filename, $alert->title, $alert->original_extension, 1, 0);
            $alert->since = Utility::getTimePastSinceDate($alert->start);
            $alert->rank = 1;
        }

        $ranked_results = Search::rankSearchResults($alerts);

        $ranked_results = $ranked_results->sortBy(function($sort){
                    return $sort->rank;
                })->reverse();
        return $ranked_results;
    }

    public static function searchEvents($query, $store)
    {
        $events = collect();
        $allStoreEvents = collect();
        
        $query_terms = explode( ' ', $query);
        
        $today = Date('Y')."-".Date('m');

        foreach ($query_terms as $term) {
            $events = $events->merge(
                                Event::join('events_target', 'events.id', '=', 'events_target.event_id')
                                ->where('title', 'LIKE', '%'.$term.'%')
                                ->where('events_target.store_id', '=', $store)
                                ->where('events.end', '>=', $today)
                                ->select('events.*')
                                ->get()
                                ->each(function($item){
                                    $item->since = Utility::getTimePastSinceDate($item->start);
                                    $item->rank = 1;
                                    $item->prettyDateStart = Utility::prettifyDate($item->start);
                                    $item->prettyDateEnd = Utility::prettifyDate($item->end);
                                })
                    );

            $allStoreEvents = $allStoreEvents->merge(
                                Event::where('title', 'LIKE', '%'.$term.'%')
                                ->where('events.all_stores', '=', 1)
                                ->where('events.end', '>=', $today)
                                ->select('events.*')
                                ->get()
                                ->each(function($item){
                                    $item->since = Utility::getTimePastSinceDate($item->start);
                                    $item->rank = 1;
                                    $item->prettyDateStart = Utility::prettifyDate($item->start);
                                    $item->prettyDateEnd = Utility::prettifyDate($item->end);
                                })
                    );

            $events = $events->merge($allStoreEvents);

            $productLaunches =  ProductLaunch::join('productlaunch_target', 'productlaunch.id', '=', 'productlaunch_target.productlaunch_id')
                                ->where('productlaunch_target.store_id', $store)
                                ->where('productlaunch.launch_date', '>=', $today)
                                ->where(function($q) use($term){
                                    $q->where('event_type', 'LIKE', '%'.$term.'%' )
                                    ->orWhere('style_number', 'LIKE', '%'.$term.'%')
                                    ->orWhere('style_name', 'LIKE', '%'.$term.'%' );    
                                })
                                
                                ->select('productlaunch.id', 'productlaunch.launch_date as start', 'productlaunch_target.store_id', 'productlaunch.event_type as event_type_name', 'productlaunch.style_number', 'productlaunch.style_name', 'productlaunch.retail_price')
                                ->get()
                                ->each(function ($item) {
                                    $item->end = Carbon::createFromFormat('Y-m-d H:i:s', $item->start)->addDay()->toDateTimeString();
                                    $title = $item->event_type_name . " - " . $item->style_number . " - " . $item->style_name . " - Reg. " . $item->retail_price;
                                    $item->title = addslashes($title);
                                    $item->event_type = EventType::getEventTypeIdByName($item->event_type_name, 1);
                                    $item->prettyDateStart = Utility::prettifyDate($item->start);
                                    $item->prettyDateEnd = Utility::prettifyDate($item->end);
                                    $item->rank = 1;
                                });
            
            $events = $events->merge($productLaunches);
        }    

        $ranked_results = Search::rankSearchResults($events);

        $ranked_results = $ranked_results->sortBy(function($sort){
                    return $sort->rank;
                })->reverse();
        return $ranked_results;
    }


    public static function searchArchivedEvents($query, $store)
    {
        $events = collect();
        $allStoreEvents = collect();
        
        $query_terms = explode( ' ', $query);
        
        $today = Date('Y')."-".Date('m');
        
        foreach ($query_terms as $term) {
            $events = $events->merge(
                                Event::join('events_target', 'events.id', '=', 'events_target.event_id')
                                ->where('title', 'LIKE', '%'.$term.'%')
                                ->where('events_target.store_id', '=', $store)
                                ->where('end', '<=', $today )
                                ->select('events.*')
                                ->get()
                                ->each(function($item){
                                    $item->since = Utility::getTimePastSinceDate($item->start);
                                    $item->rank = 1;
                                    $item->archived = true;
                                    $item->prettyDateStart = Utility::prettifyDate($item->start);
                                    $item->prettyDateEnd = Utility::prettifyDate($item->end);

                                })
                    );

            $allStoreEvents = $allStoreEvents->merge(
                                Event::where('title', 'LIKE', '%'.$term.'%')
                                ->where('events.all_stores', '=', 1)
                                ->where('end', '<=', $today )
                                ->select('events.*')
                                ->get()
                                ->each(function($item){
                                    $item->since = Utility::getTimePastSinceDate($item->start);
                                    $item->rank = 1;
                                    $item->archived = true;
                                    $item->prettyDateStart = Utility::prettifyDate($item->start);
                                    $item->prettyDateEnd = Utility::prettifyDate($item->end);

                                })
                    );

            $events = $events->merge($allStoreEvents);


            $productLaunches =  ProductLaunch::join('productlaunch_target', 'productlaunch.id', '=', 'productlaunch_target.productlaunch_id')
                                ->where('productlaunch_target.store_id', $store)
                                ->where('productlaunch.launch_date', '<', $today)
                                ->where(function($q) use($term){
                                    $q->where('event_type', 'LIKE', '%'.$term.'%' )
                                    ->orWhere('style_number', 'LIKE', '%'.$term.'%')
                                    ->orWhere('style_name', 'LIKE', '%'.$term.'%' );    
                                })
                                
                                ->select('productlaunch.id', 'productlaunch.launch_date as start', 'productlaunch_target.store_id', 'productlaunch.event_type as event_type_name', 'productlaunch.style_number', 'productlaunch.style_name', 'productlaunch.retail_price')
                                ->get()
                                ->each(function ($item) {
                                    $item->end = Carbon::createFromFormat('Y-m-d H:i:s', $item->start)->addDay()->toDateTimeString();
                                    $title = $item->event_type_name . " - " . $item->style_number . " - " . $item->style_name . " - Reg. " . $item->retail_price;
                                    $item->title = addslashes($title);
                                    $item->event_type = EventType::getEventTypeIdByName($item->event_type_name, 1);
                                    $item->prettyDateStart = Utility::prettifyDate($item->start);
                                    $item->prettyDateEnd = Utility::prettifyDate($item->end);
                                    $item->rank = 1;
                                    $item->archived = true;
                                });
            
            $events = $events->merge($productLaunches);
        }

        $ranked_results = Search::rankSearchResults($events);

        $ranked_results = $ranked_results->sortBy(function($sort){
                    return $sort->rank;
                })->reverse();
        return $ranked_results;
    }

    public static function searchVideos($query, $store)
    {
        $videos = collect();
        $allStoreVideos = collect();

        $query_terms = explode(' ', $query);

        $banner_id = StoreInfo::getStoreInfoByStoreId($store)->banner_id;

        foreach ($query_terms as $term) {

            //search title, description
            $videos = $videos->merge(

                                    Video::join('video_target', 'video_target.video_id', '=', 'videos.id')
                                        ->where('video_target.store_id', $store)
                                        ->where(function($q) use($term){
                                                $q->where('title', 'LIKE', '%'.$term.'%' )
                                                ->orWhere('description', 'LIKE', '%'.$term.'%');
                                            })
                                        ->where('videos.deleted_at', '=', null)
                                        ->select('videos.*')
                                        ->get()
                                        ->each(function($video){
                                            $video->rank = 1;
                                            $video->since = Utility::getTimePastSinceDate($video->updated_at);
                                        })

                );

            $allStoreVideos = $allStoreVideos->merge(
                    
                                    Video::join('video_banner', 'videos.id', '=', 'video_banner.video_id' )          
                                        ->where('videos.all_stores', 1)
                                        ->where('video_banner.banner_id', $banner_id)
                                        ->where(function($q) use($term){
                                                $q->where('title', 'LIKE', '%'.$term.'%' )
                                                ->orWhere('description', 'LIKE', '%'.$term.'%');
                                            })
                                        ->where('videos.deleted_at', '=', null)
                                        ->select('videos.*')
                                        ->get()
                                        ->each(function($video){
                                            $video->rank = 1;
                                            $video->since = Utility::getTimePastSinceDate($video->updated_at);
                                        })

                );

            $videos = $videos->merge($allStoreVideos);

            //search tags
            // $videos = $videos->merge(
            //         Video::join('video_tags', 'video_tags.video_id', '=', 'videos.id')
            //         ->join('tags', 'tags.id', '=', 'video_tags.tag_id')
            //         ->where('tags.name','LIKE', '%'.$term.'%')
            //         ->where('video_tags.deleted_at', '=', null)
            //         ->where('tags.deleted_at', '=', null)
            //         ->select('videos.*')
            //         ->get()
            //         ->each(function($video){
            //             $video->rank = 1;
            //             $video->since = Utility::getTimePastSinceDate($video->updated_at);
            //         })
            //     );
        }
        
        $ranked_results = Search::rankSearchResults($videos);

        $ranked_results = $ranked_results->sortBy(function($sort){
                    return $sort->rank;
                })->reverse();
        return $ranked_results;
    }

    public static function rankSearchResults($results)
    {
        
        $ranked_results = new Collection;
        $ranked_ids = [];
        foreach ($results as $result) {
            
            if ( in_array($result['id'], $ranked_ids)) {                 
                $index = (array_search($result['id'], $ranked_ids));
                $ranked_results[$index]['rank'] = $ranked_results[$index]['rank']+1;
            }
            else{
                array_push($ranked_ids, $result['id']);
                $ranked_results->add($result);
            }
        }
        return ( $ranked_results );
    }
}
