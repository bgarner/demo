<?php

namespace App\Models\Event;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Tag\ContentTag;
use App\Models\StoreApi\Banner;
use App\Models\Auth\User\UserBanner;
use App\Models\Auth\User\UserSelectedBanner;
use App\Models\Event\EventType;
use App\Models\Event\EventTarget;
use Carbon\Carbon;
use App\Models\Validation\EventValidator;
use App\Models\Event\EventAttachment;
use App\Models\ProductLaunch\ProductLaunch;
use App\Models\Utility\Utility;
use App\Models\StoreApi\StoreInfo;
use App\Models\Tools\CustomStoreGroup;

class Event extends Model
{
    use SoftDeletes;
    protected $table = 'events';
    protected $dates = ['deleted_at'];
    protected $fillable = ['title', 'description', 'event_type', 'start', 'end', 'all_day', 'all_stores'];

    public static function validateEvent($request)
    {
        $validateThis = [
                        'title'         => $request['title'],
                        'event_type'    => $request['event_type'],
                        'start'         => $request['start'],
                        'end'           => $request['end'],
                      ];
        if ($request['target_stores'] != NULL) {
            $validateThis['target_stores'] = $request['target_stores'];
        }
        if ($request['target_banners'] != NULL) {
            $validateThis['target_banners'] = $request['target_banners'];
        }
        if ($request['store_groups'] != NULL) {
            $validateThis['store_groups'] = $request['store_groups'];
        }

        if ($request['all_stores'] != NULL) {
            $validateThis['allStores'] = $request['all_stores'];
        }

        $v = new EventValidator();

        return $v->validate($validateThis);

    }

    public static function storeEvent($request)
    {
        \Log::info($request);
        $validate = Event::validateEvent($request);

        if($validate['validation_result'] == 'false') {
          return json_encode($validate);
        }

        $banner = UserSelectedBanner::getBanner();
        $desc = preg_replace('/\n+/', '', $request['description']);
        $event = Event::create([


    		'banner_id' => $banner->id,
            'title' => addslashes($request['title']),
            'event_type' => $request['event_type'],
            'description' => $desc,
            'start' => $request['start'],
            'end' => $request['end'],
            'all_day' => $request['allDay']


    	   ]);

        EventTarget::updateTargetStores($event->id, $request);
        EventAttachment::updateAttachments($event->id, $request);
        return json_encode($event);

    }

    public static function updateEvent($id, $request)
    {
        $validate = Event::validateEvent($request);
        if($validate['validation_result'] == 'false') {
          return json_encode($validate);
        }

        $event = Event::find($id);

        $event->title = $request['title'];
        $event->event_type = $request['event_type'];
        $event->description = preg_replace('/\n+/', '', $request['description']);
        $event->start = $request['start'];
        $event->end = $request['end'];
        $event->all_day = $request['allDay'];

        $event->save();

        EventTarget::updateTargetStores($id, $request);
        EventAttachment::updateAttachments($id, $request);
        return json_encode($event);

    }

    

    public static function updateTags($id, $tags)
    {
    	ContentTag::where('content_type', 'event')->where('content_id', $id)->delete();
        foreach ($tags as $tag) {
            ContentTag::create([
                'content_type' => 'event',
                'content_id'      => $id,
                'tag_id'          => $tag
            ]);
        }
        return;
    }

    public static function getActiveEventsAndProductLaunchForCalendarViewByStore($storeNumber)
    {
        $events = Event::getActiveEventsByStore($storeNumber);
        $productLaunches = ProductLaunch::getActiveProductLaunchByStoreForCalendar($storeNumber);

        $events = $events->merge($productLaunches);
        foreach ($events as $event) {
            $event->prettyDateStart = Utility::prettifyDate($event->start);
            $event->prettyDateEnd = Utility::prettifyDate($event->end);
            $event->since = Utility::getTimePastSinceDate($event->start);
            $event->event_type_name = EventType::getName($event->event_type);
            $event->background_colour = EventType::getBackground($event->event_type);
            $event->foreground_colour = EventType::getForeground($event->event_type);
            if( 
                strpos(EventType::getName($event->event_type), "Launch") || 
                strpos(EventType::getName($event->event_type), "launch" ) ||
                strpos(EventType::getName($event->event_type), "Release" ) ||
                strpos(EventType::getName($event->event_type), "release" ) 
                ){
                    $event->all_day = 1;
            }
        }

        return $events;

    }

    public static function getActiveEventsByStore($store_id)
    {
        $banner_id = StoreInfo::getStoreInfoByStoreId($store_id)->banner_id;

        $allStoreEvents = Event::join('event_banner', 'event_banner.event_id', '=', 'events.id' )
                            ->where('all_stores', '1')
                            ->where('event_banner.banner_id', $banner_id)
                            ->select('events.*')
                            ->orderBy('start')
                            ->get();

        $targetedEvents = Event::join('events_target', 'events.id', '=', 'events_target.event_id')
                        ->where('store_id', $store_id)
                        ->select('events.*')
                        ->orderBy('start')
                        ->get();


        $storeGroups = CustomStoreGroup::getStoreGroupsForStore($store_id);
        $storeGroupEvents = Event::join('event_store_groups', 'event_store_groups.event_id', '=', 'events.id')
                                    ->whereIn('event_store_groups.store_group_id', $storeGroups)
                                    ->select('events.*')
                                    ->get();

        $allEvents = $allStoreEvents->merge($targetedEvents)->merge($storeGroupEvents)
                    ->each(function($event)use($store_id){
                        $attachments = EventAttachment::getEventAttachments($event->id);
                        $attachment_link_string = "";
                        foreach ($attachments as $a) {
                            $attachment_link_string .= "<a href='/".$store_id."/document#!/".$a->id."'>". $a->name ."</a><br>";
                        }
                        $event->attachment = $attachment_link_string;
                    });

        return $allEvents;
    }

    public static function getActiveEventsAndProductLaunchForCalendarViewByStorelist($storesByBanner, $storeGroups)
    {
        
        $storelist = $storesByBanner->flatten()->toArray();
        $events = Event::getActiveEventsForStoreList($storesByBanner, $storeGroups);
        $productLaunches = ProductLaunch::getActiveProductLaunchByStorelistForCalendar($storelist);

        $events = $events->merge($productLaunches);
        foreach ($events as $event) {
            $event->prettyDateStart = Utility::prettifyDate($event->start);
            $event->prettyDateEnd = Utility::prettifyDate($event->end);
            $event->since = Utility::getTimePastSinceDate($event->start);
            $event->event_type_name = EventType::getName($event->event_type);
            $event->background_colour = EventType::getBackground($event->event_type);
            $event->foreground_colour = EventType::getForeground($event->event_type);
            $target_string = "";
                        
            if( $event->stores != NULL ){
                $target_string .= "<p>";
                foreach ($event->stores as $store) {
                    $target_string .= "<span class='badge'>". $store ."</span>";
                }
                $target_string .= "</p>";
            }
            if( $event->all_stores == 1 ) {
                $target_string .= "<p><span class='badge'>". $event->banner ."</span></p>";

            }
                        
            $event->target = $target_string;
        }
        return $events;

    }

    public static function getActiveEventsForStoreList($storesByBanner, $storeGroups )
    {

        $storeNumbersArray = $storesByBanner->flatten()->toArray();
        $allStoreEvents = Event::join('event_banner', 'event_banner.event_id', '=', 'events.id' )
                            ->where('all_stores', '1')
                            ->whereIn('event_banner.banner_id', $storesByBanner->keys())
                            ->select('events.*', 'event_banner.banner_id')
                            ->orderBy('start')
                            ->get()
                            ->each(function($event){
                                        $event->banner = Banner::find($event->banner_id)->name;
                                    });

        $targetedEvents = Event::join('events_target', 'events.id', '=', 'events_target.event_id')
                        ->whereIn('store_id', $storeNumbersArray)
                        ->select(\DB::raw('events.*, GROUP_CONCAT(DISTINCT events_target.store_id) as stores'))
                        ->groupBy('events.id')
                        ->orderBy('start')
                        ->get()
                        ->each(function($event){
                            $event->stores = explode(',', $event->stores);
                        });


        $storeGroupEvents = Event::join('event_store_groups', 'event_store_groups.event_id', '=', 'events.id')
                                    ->whereIn('event_store_groups.store_group_id', $storeGroups)
                                    ->select(\DB::raw('events.*, GROUP_CONCAT(DISTINCT event_store_groups.store_group_id) as store_groups'))
                                                ->groupBy('events.id')
                                                ->get()
                                                ->each(function($item) use ($storeNumbersArray){
                                                    $store_groups = explode(',', $item->store_groups);

                                                    $item->store_groups = $store_groups;
                                                    $group_stores = [];
                                                    foreach ($store_groups as $group) {
                                                        $stores = unserialize(CustomStoreGroup::find($group)->stores);
                                                        $group_stores = array_merge($group_stores,$stores);
                                                    }
                                                    
                                                    $group_stores = array_unique( $group_stores);

                                                    $item->stores = array_intersect($storeNumbersArray, $group_stores);
                                                });

        $allEvents = $allStoreEvents->merge($targetedEvents)->merge($storeGroupEvents)
                    ->each(function($event) use($storesByBanner) {
                        $attachments = EventAttachment::getEventAttachments($event->id);
                        $attachment_link_string = "";
                        foreach ($attachments as $a) {
                            $attachment_link_string .= "<a href='/".$store_id."/document#!/".$a->id."'>". $a->name ."</a><br>";
                        }
                        $event->attachment = $attachment_link_string;

                    });

        return $allEvents;
    }



    public static function getListofEventsByStoreAndMonth($storeNumber, $yearMonth)
    {
        $eventsList = Event::getActiveEventsByStoreAndMonth($storeNumber, $yearMonth);
        $productLaunchList = ProductLaunch::getActiveProductLaunchByStoreandMonth($storeNumber, $yearMonth);

        $eventsList = $eventsList->toArray();
        $productLaunchList = $productLaunchList->toArray();
        foreach ($productLaunchList as $date => $launch) {
            if(array_key_exists($date, $eventsList)){
                foreach($launch as $key => $launchObj){
                    array_push($eventsList[$date], $launchObj);
                }
            }
            else{
                $eventsList[$date] = $launch;
            }
        }
        ksort($eventsList);
        $eventsList = json_decode(json_encode($eventsList));
        
        return $eventsList;
    }

    public static function getActiveEventsByStoreAndMonth($store_id, $yearMonth)
    {
        $banner_id = StoreInfo::getStoreInfoByStoreId($store_id)->banner_id;
        $targetedEvents = Event::join('events_target', 'events.id', '=', 'events_target.event_id')
                    ->join('event_types', 'events.event_type', '=', 'event_types.id')
                    ->where('store_id', $store_id)
                    ->where('start', 'LIKE', $yearMonth.'%')
                    ->select('events.*', 'event_types.event_type as event_type_name', 'event_types.foreground_colour', 'event_types.background_colour' )
                    ->orderBy('start')
                    ->get()
                    ->each(function ($item) {
                        $item->prettyDateStart = Utility::prettifyDate($item->start);
                        $item->prettyDateEnd = Utility::prettifyDate($item->end);
                        $item->since = Utility::getTimePastSinceDate($item->start);
                    });
                    

        $allStoreEvents = Event::join('event_banner', 'event_banner.event_id', '=', 'events.id' )    
                        ->join('event_types', 'events.event_type', '=', 'event_types.id')
                        ->where('all_stores', 1)
                        ->where('event_banner.banner_id', $banner_id)
                        ->where('start', 'LIKE', $yearMonth.'%')
                        ->select('events.*', 'event_types.event_type as event_type_name', 'event_types.foreground_colour', 'event_types.background_colour' )
                        ->orderBy('start')
                        ->get()
                        ->each(function ($item) {
                            $item->prettyDateStart = Utility::prettifyDate($item->start);
                            $item->prettyDateEnd = Utility::prettifyDate($item->end);
                            $item->since = Utility::getTimePastSinceDate($item->start);
                        });

        $storeGroups = CustomStoreGroup::getStoreGroupsForStore($store_id);
        $storeGroupEvents = Event::join('event_store_groups', 'event_store_groups.event_id', '=', 'events.id')
                        ->join('event_types', 'events.event_type', '=', 'event_types.id')
                        ->whereIn('event_store_groups.store_group_id', $storeGroups)
                        ->where('start', 'LIKE', $yearMonth.'%')
                        ->select('events.*', 'event_types.event_type as event_type_name', 'event_types.foreground_colour', 'event_types.background_colour' )
                        ->orderBy('start')
                        ->get()
                        ->each(function ($item) {
                            $item->prettyDateStart = Utility::prettifyDate($item->start);
                            $item->prettyDateEnd = Utility::prettifyDate($item->end);
                            $item->since = Utility::getTimePastSinceDate($item->start);
                        });
                        
        $events = $targetedEvents->merge($allStoreEvents);
        $events = $events->merge($storeGroupEvents);

        foreach($events as $event){
            $start = Carbon::createFromFormat('Y-m-d H:i:s', $event->start);
            $end = Carbon::createFromFormat('Y-m-d H:i:s', $event->end);
            $differenceInHours = $start->diffInHours($end);
            
            while($differenceInHours > 24){
                
                $start = $start->addDay();
                $newEvent = $event->replicate();
                $newEvent->id = Carbon::now()->timestamp ;
                $newEvent->start = $start->toDateTimeString();
                $newEvent->prettyDateStart = Utility::prettifyDate($newEvent->start);
                $newEvent->prettyDateEnd = Utility::prettifyDate($newEvent->end);
                $newEvent->since = Utility::getTimePastSinceDate($newEvent->start);
                $events->push($newEvent);
                $differenceInHours = $start->diffInHours($end);
                
            }
        }

        $events = $events->groupBy(function($event) {
                return Carbon::parse($event->start)->format('Y-m-d');
        });

        return $events;
    }

    public static function getListofEventsByStorelistAndMonth($storesByBanner, $storeGroups, $yearMonth)
    {
        $storelist = $storesByBanner->flatten()->toArray();
        $eventsList = Event::getActiveEventsByStorelistAndMonth($storesByBanner, $storeGroups, $yearMonth);
        
        $productLaunchList = ProductLaunch::getActiveProductLaunchByStorelistandMonth($storelist, $yearMonth);

        $eventsList = $eventsList->toArray();
        $productLaunchList = $productLaunchList->toArray();

        foreach ($productLaunchList as $date => $launch) {
            if(array_key_exists($date, $eventsList)){
                foreach($launch as $key => $launchObj){
                    array_push($eventsList[$date], $launchObj);
                }
            }
            else{
                $eventsList[$date] = $launch;
            }
        }
        ksort($eventsList);
        $eventsList = json_decode(json_encode($eventsList));
        
        return $eventsList;
    }


    public static function getActiveEventsByStorelistAndMonth($storesByBanner, $storeGroups, $yearMonth)
    {
        
        $storelist = $storesByBanner->flatten()->toArray();
        $targetedEvents = Event::join('events_target', 'events.id', '=', 'events_target.event_id')
                    ->join('event_types', 'events.event_type', '=', 'event_types.id')
                    ->whereIn('events_target.store_id', $storelist)
                    ->where('start', 'LIKE', $yearMonth.'%')
                    ->select(\DB::raw('events.*, event_types.event_type as event_type_name, event_types.foreground_colour, event_types.background_colour, GROUP_CONCAT(DISTINCT events_target.store_id) as stores'))
                    
                    ->groupBy('events.id')
                    ->orderBy('start')
                    ->get()
                    ->each(function($event){
                        $event->stores = explode(',', $event->stores);
                        $event->prettyDateStart = Utility::prettifyDate($event->start);
                        $event->prettyDateEnd = Utility::prettifyDate($event->end);
                        $event->since = Utility::getTimePastSinceDate($event->start);
                    });
                    

        $allStoreEvents = Event::join('event_banner', 'event_banner.event_id', '=', 'events.id' )    
                        ->join('event_types', 'events.event_type', '=', 'event_types.id')
                        ->where('all_stores', 1)
                        ->whereIn('event_banner.banner_id', $storesByBanner->keys())
                        ->where('start', 'LIKE', $yearMonth.'%')
                        ->select('events.*', 'event_types.event_type as event_type_name', 'event_types.foreground_colour', 'event_types.background_colour' , 'event_banner.banner_id')
                        
                        ->orderBy('start')
                        ->get()
                        ->each(function($event){
                            $event->banner = Banner::find($event->banner_id)->name;
                            $event->prettyDateStart = Utility::prettifyDate($event->start);
                            $event->prettyDateEnd = Utility::prettifyDate($event->end);
                            $event->since = Utility::getTimePastSinceDate($event->start);
                        });

        $storeGroupEvents = Event::join('event_store_groups', 'event_store_groups.event_id', '=', 'events.id')
                        ->join('event_types', 'events.event_type', '=', 'event_types.id')
                        ->whereIn('event_store_groups.store_group_id', $storeGroups)
                        ->where('start', 'LIKE', $yearMonth.'%')
                        ->select(\DB::raw('events.*, event_types.event_type as event_type_name, event_types.foreground_colour, event_types.background_colour, GROUP_CONCAT(DISTINCT event_store_groups.store_group_id) as store_groups'))
                        ->groupBy('events.id')
                        ->orderBy('start')
                        ->get()
                        ->each(function($item) use ($storelist){
                            $store_groups = explode(',', $item->store_groups);

                            $item->store_groups = $store_groups;
                            $group_stores = [];
                            foreach ($store_groups as $group) {
                                
                                $stores = unserialize(CustomStoreGroup::find($group)->stores);
                                $group_stores = array_merge($group_stores,$stores);
                            }
                            
                            $group_stores = array_unique( $group_stores);

                            $item->stores = array_intersect($storelist, $group_stores);
                            $item->prettyDateStart = Utility::prettifyDate($item->start);
                            $item->prettyDateEnd = Utility::prettifyDate($item->end);
                            $item->since = Utility::getTimePastSinceDate($item->start);
                        });

        
        $events = $targetedEvents->merge($allStoreEvents);

        $events = $events->merge($storeGroupEvents);

        foreach($events as $event){
            $start = Carbon::createFromFormat('Y-m-d H:i:s', $event->start);
            $end = Carbon::createFromFormat('Y-m-d H:i:s', $event->end);
            $differenceInHours = $start->diffInHours($end);
            
            while($differenceInHours > 24){
                
                $start = $start->addDay();
                $newEvent = $event->replicate();
                $newEvent->id = Carbon::now()->timestamp ;
                $newEvent->start = $start->toDateTimeString();
                $newEvent->prettyDateStart = Utility::prettifyDate($newEvent->start);
                $newEvent->prettyDateEnd = Utility::prettifyDate($newEvent->end);
                $newEvent->since = Utility::getTimePastSinceDate($newEvent->start);
                $events->push($newEvent);
                $differenceInHours = $start->diffInHours($end);
                
            }
        }

        $events = $events->groupBy(function($event) {
                return Carbon::parse($event->start)->format('Y-m-d');
        });

        return $events;
    }

    public static function getEventsForAdmin()
    {
        $banner = UserSelectedBanner::getBanner()->id;
        //stores in accessible banners
        $storeList = [];
        // foreach ($banners as $banner) {
            $storeInfo = StoreInfo::getStoresInfo($banner);
            foreach ($storeInfo as $store) {
                array_push($storeList, $store->store_number);
            }
        // }

        $allStoreEvents = Event::join('event_banner', 'event_banner.event_id', '=', 'events.id')
                                ->where('all_stores', 1)
                                ->where('event_banner.banner_id', $banner)
                                ->select('events.*', 'event_banner.banner_id')
                                ->get();

        $allStoreEvents = Utility::groupBannersForAllStoreContent($allStoreEvents);

        
        $targetedEvents = Event::join('events_target', 'events_target.event_id', '=', 'events.id')
                                ->whereIn('events_target.store_id', $storeList)
                                ->select(\DB::raw('events.*, GROUP_CONCAT(DISTINCT events_target.store_id) as stores'))
                                ->groupBy('events.id')
                                ->get()
                                ->each(function($event){
                                    $event->stores = explode(',', $event->stores);
                                });

        $storeGroups = CustomStoreGroup::getStoreGroupsForAdmin();
        $eventsForStoreGroups = Event::join('event_store_groups', 'event_store_groups.event_id', '=', 'events.id')
                                            ->whereIn('event_store_groups.store_group_id', $storeGroups)
                                            ->select('events.*')
                                            ->get()
                                            ->each(function($item){
                                                $storeGroups = EventStoreGroup::where('event_id', $item->id)->get()->pluck('store_group_id')->toArray();
                                                $item->storeGroups = $storeGroups;
                                                $item->stores = [];
                                                foreach ($storeGroups as $group) {
                                                    $stores = unserialize(CustomStoreGroup::find($group)->stores);
                                                    $item->stores = array_merge($item->stores,$stores);
                                                }
                                                $item->stores = array_unique( $item->stores);
                                            });

        $targetedEvents = Utility::mergeTargetedAndStoreGroupContent($targetedEvents, $eventsForStoreGroups);
                                           
        $events = Utility::mergeTargetedAndAllStoreContent($targetedEvents, $allStoreEvents);

        foreach ($events as $event) {
            
            $event->background_colour = EventType::getBackground($event->event_type);
            $event->foreground_colour = EventType::getForeground($event->event_type);
            $event->event_type = EventType::getName($event->event_type);
            $event->prettyStartDate = Utility::prettifyDate($event->start);
            $event->prettyEndDate = Utility::prettifyDate($event->end);
        }
                        
                        
        return $events;
    }

    public static function getSelectedStoresAndBannersByEventId($event_id)
    {
        $targetBanners = EventBanner::where('event_id', $event_id)->get()->pluck('banner_id')->toArray();
        $targetStores = EventTarget::where('event_id', $event_id)->get()->pluck('store_id')->toArray();
        $storeGroups = EventStoreGroup::where('event_id', $event_id)->get()->pluck('store_group_id')->toArray();

        $optGroupSelections = [];
        foreach ($targetBanners as $banner) {
            array_push($optGroupSelections, 'banner'.$banner);
        }
        foreach ($targetStores as $stores) {
            array_push($optGroupSelections, 'store'.$stores);   
        }
        foreach ($storeGroups as $group) {
            array_push($optGroupSelections, 'storegroup'.$group);   
        }

        return( $optGroupSelections );
    }

}
