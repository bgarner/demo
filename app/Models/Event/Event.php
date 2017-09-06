<?php

namespace App\Models\Event;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Tag\ContentTag;
use App\Models\StoreApi\Banner;
use App\Models\Auth\User\UserBanner;
use App\Models\Auth\User\UserSelectedBanner;
use App\Models\Event\EventType;
use Carbon\Carbon;
use App\Models\Validation\EventValidator;
use App\Models\Event\EventAttachment;
use App\Models\ProductLaunch\ProductLaunch;
use App\Models\Utility\Utility;
use App\Models\StoreApi\StoreInfo;

class Event extends Model
{
    use SoftDeletes;
    protected $table = 'events';
    protected $dates = ['deleted_at'];
    protected $fillable = ['banner_id', 'title', 'description', 'event_type', 'start', 'end', 'all_day', 'all_stores'];

    public static function validateEvent($request)
    {
        $validateThis = [
                        'title'         => $request['title'],
                        'event_type'    => $request['event_type'],
                        'start'         => $request['start'],
                        'end'           => $request['end'],
                        'target_stores' => $request['target_stores'],

                      ];
        if ($request['allStores'] != NULL) {
            $validateThis['allStores'] = $request['allStores'];
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
            'title' => $request['title'],
            'event_type' => $request['event_type'],
            'description' => $desc,
            'start' => $request['start'],
            'end' => $request['end'],
            'all_day' => $request['allDay']


    	   ]);

        Event::updateTargetStores($event->id, $request);
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

        Event::updateTargetStores($id, $request);
        EventAttachment::updateAttachments($id, $request);
        return json_encode($event);

    }

    public static function updateTargetStores($id, $request)
        {
            $target_stores = $request['target_stores'];
            $allStores = $request['allStores'];
            if($allStores == 'on') {
                EventTarget::where('event_id', $id)->delete();
                $event = Event::find($id);
                $event->all_stores = 1;
                $event->save();
            }
            else{
                EventTarget::where('event_id', $id)->delete();
                if (count($target_stores) > 0) {
                    foreach ($target_stores as $store) {
                        EventTarget::create([
                            'event_id'   => $id,
                            'store_id'   => $store
                        ]);
                    }
                    if(!in_array('0940', $target_stores)){
                        Utility::addHeadOffice($id, 'events_target', 'event_id');
                    }
                }
                $event = Event::find($id);
                $event->all_stores = 0;
                $event->save();
            }

            return;
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
        }
        return $events;

    }

    public static function getActiveEventsByStore($store_id)
    {
        $banner_id = StoreInfo::getStoreInfoByStoreId($store_id)->banner_id;

        $allStoreEvents = Event::where('all_stores', '1')
                            ->where('banner_id', $banner_id)
                            ->select('events.*')
                            ->orderBy('start')
                            ->get();

        $targetedEvents = Event::join('events_target', 'events.id', '=', 'events_target.event_id')
                        ->where('store_id', $store_id)
                        ->select('events.*')
                        ->orderBy('start')
                        ->get();

        $allEvents = $allStoreEvents->merge($targetedEvents)
                    ->each(function($event){
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
                    

        $allStoreEvents = Event::join('event_types', 'events.event_type', '=', 'event_types.id')
                        ->where('all_stores', 1)
                        ->where('start', 'LIKE', $yearMonth.'%')
                        ->select('events.*', 'event_types.event_type as event_type_name', 'event_types.foreground_colour', 'event_types.background_colour' )
                        ->orderBy('start')
                        ->get()
                        ->each(function ($item) {
                            $item->prettyDateStart = Utility::prettifyDate($item->start);
                            $item->prettyDateEnd = Utility::prettifyDate($item->end);
                            $item->since = Utility::getTimePastSinceDate($item->start);
                        });
                        
        $events = $targetedEvents->merge($allStoreEvents)->groupBy(function($event) {
                            return Carbon::parse($event->start)->format('Y-m-d');
                    });
        
        return $events;
    }

    public static function getEventsByBannerId()
    {
        $banner = UserSelectedBanner::getBanner();
        return Event::join('event_types', 'events.event_type', '=', 'event_types.id')
                    ->where('events.banner_id', $banner->id)
                    ->select('events.*', 'event_types.event_type', 'event_types.foreground_colour', 'event_types.background_colour' )      
                    ->get()
                    ->each(function($item){
                        $item->prettyStartDate = Utility::prettifyDate($item->start);
                        $item->prettyEndDate = Utility::prettifyDate($item->end);
                    });
    }

}
