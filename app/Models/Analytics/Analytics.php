<?php

namespace App\Models\Analytics;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use DB;
use App\Models\Utility\Utility;
use App\Models\Communication\Communication;
use App\Models\Communication\CommunicationTarget;
use App\Models\Communication\CommunicationType;
use App\Models\UrgentNotice\UrgentNotice;
use App\Models\UrgentNotice\UrgentNoticeTarget;
use App\Models\Document\Document;
use App\Models\Video\Video;
use App\Models\Video\Playlist;
use App\Models\Dashboard\Quicklinks;
use App\Models\Analytics\AnalyticsCollection;

class Analytics extends Model
{
    protected $table = 'analytics';
    protected $fillable = ['device', 'type', 'resource_id', 'store_number', 'location', 'location_id'];

    public static function store($request)
    {
    	$event = Analytics::create([
            'device' => $request->device,
    		'type' => $request->type,
 			'resource_id' => $request->resource_id,
    		'store_number' => $request->store_number,
 			'location' => $request->location,
 			'location_id' => $request->location_id
 		]);

 		$event->save();
    }

    public static function getCommunicationStats()
    {
    	
        $comms = AnalyticsCollection::getActiveCommunicationStats();
        return $comms;
    }

    public static function getUrgentNoticeStats()
    {
    	$notices = AnalyticsCollection::getActiveUrgentNoticeStats();
    	return $notices;
    }

    public static function getAlertsStats()
    {
        $alerts = AnalyticsCollection::getActiveAlertsStats();
        return $alerts;
    }


    public static function getLastXActivitiesByStore($storeNumber, $fetch=50)
    {
        $activities = Analytics::where('store_number', '=', $storeNumber)
                                ->orderBy('created_at', 'desc')
                                ->take($fetch)
                                ->get();
        foreach($activities as $a){

            switch($a->type){
                case "file":
                    $type = "File Opened";
                    $file = Document::find($a->resource_id);
                    $icon = "fa-book";
                    $title = $file['title'];
                    break;

                case "communication":
                    $communication = Communication::find($a->resource_id);
                    $icon = "fa-bullhorn";
                    $title = $communication['subject'];
                    break;

                case "urgentnotice":
                    $urgentnotice = Urgentnotice::find($a->resource_id);
                    $icon = "fa-bolt";
                    $title = $urgentnotice['title'];
                    break;

                case "video":
                    $video = Video::find($a->resource_id);
                    $icon = "fa-video-camera";
                    $title = $video['title'];
                    break;

                case "playlist":
                    $playlist = Playlist::find($a->resource_id);
                    $icon = "fa-list";
                    $title = $playlist['title'];
                    break;

                case "external_url":
                    $quicklinks = Quicklinks::find($a->resource_id);
                    $icon = "fa-link";
                    $title = $quicklinks['link_name'];
                    break;

                default:
                    $title = "";
                    $icon ="";
                    break;
            }

            $a->title = $title;
            $a->icon = $icon;
            $a->since = Utility::getTimePastSinceDate($a->created_at);
            if($a->device == "Android"){
                $a->device = "Tablet";
            }

        }

        return $activities;
    }
}
