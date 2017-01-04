<?php

namespace App\Models\Event;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Tag\ContentTag;
use App\Models\Banner;
use App\Models\UserBanner;
use App\Models\UserSelectedBanner;
use App\Models\Event\EventType;
use Carbon\Carbon;
use App\Models\Validation\EventValidator;
use App\Models\Utility\Utility;

class Event extends Model
{
	use SoftDeletes;
    protected $table = 'events';
    protected $dates = ['deleted_at'];
    protected $fillable = ['banner_id', 'title', 'description', 'event_type', 'start', 'end'];

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
            'end' => $request['end']
    	   ]);
        
        $event = Event::updateTargetStores($event->id, $request);
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
        
        $event->save();

        Event::updateTargetStores($id, $request);
        return json_encode($event);

    }

    public static function updateTargetStores($id, $request)
      {
         $target_stores = $request['target_stores'];
         $allStores = $request['allStores'];
         
         if (!( $target_stores == '' && $allStores == 'on' )) {
             EventTarget::where('event_id', $id)->delete();
             if (count($target_stores) > 0) {
                 foreach ($target_stores as $store) {
                     EventTarget::create([
                        'event_id'   => $id,
                        'store_id'   => $store
                     ]);
               
                  } 
             }            
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

    public static function getActiveEventsByStore($store_id)
    {
      $events = Event::join('events_target', 'events.id', '=', 'events_target.event_id')
                        ->where('store_id', $store_id)
                        ->orderBy('start')
                        ->get();
      return $events;
    }

    public static function getActiveEventsByStoreAndMonth($store_id, $yearMonth)
    {
        $events = Event::join('events_target', 'events.id', '=', 'events_target.event_id')
                    ->where('store_id', $store_id)
                    ->where('start', 'LIKE', $yearMonth.'%')
                    
                    ->orderBy('start')
                    ->get()
                    ->each(function ($item) {
                        $item->prettyDateStart = Utility::prettifyDate($item->start);
                        $item->prettyDateEnd = Utility::prettifyDate($item->end);
                        $item->since = Utility::getTimePastSinceDate($item->start);
                        $item->event_type_name = EventType::getName($item->event_type);                        
                    })
                    ->groupBy(function($event) {
                            return Carbon::parse($event->start)->format('Y-m-d');
                    });
                    
        return $events;
    }

    public static function createProductLaunchEvent($productLaunchDetails)
    {
        $stores = explode(';', $productLaunchDetails['stores']);
        if($stores[count($stores) -1 ] == 0){
            array_pop($stores);
        }

        $event_types_list = EventType::where('banner_id', $productLaunchDetails['banner_id'])->lists('event_type', 'id')->toArray();
        $event_type_id = array_keys($event_types_list, $productLaunchDetails['event_type']);

        
        $start = Carbon::createFromFormat('Y/m/d H:i:s', $productLaunchDetails['launch_date']);
        
        $event = Event::create([
            'banner_id' => $productLaunchDetails['banner_id'],
            'title' => $productLaunchDetails['title'],
            'event_type' => $event_type_id[0],
            'start' => $start->toDatetimeString(),
            'end' => $start->addDay()->toDatetimeString()

        ]);
        
        foreach ($stores as $key => $value) {
            EventTarget::create([
                    'store_id' => $value,
                    'event_id' => $event->id    

                ]);
        }

        return;
    }

}

