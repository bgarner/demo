<?php

namespace App\Models\Event;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Tag\ContentTag;
use App\Models\Banner;
use App\Models\UserBanner;
use App\Models\UserSelectedBanner;
use Carbon\Carbon;

class Event extends Model
{
	  use SoftDeletes;
    protected $table = 'events';
    protected $dates = ['deleted_at'];
    protected $fillable = ['banner_id', 'title', 'description', 'event_type', 'start', 'end'];

    public static function storeEvent($request)
    {
    	\Log::info($request->all);
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
        Event::updateTargetStores($event->id, $request);
    	return;
    }

    public static function updateEvent($id, $request)
    {
        $event = Event::find($id);

        $event->title = $request['title'];
        $event->event_type = $request['event_type'];
        $event->description = preg_replace('/\n+/', '', $request['description']);
        $event->start = $request['start'];
        $event->end = $request['end'];
        
        $event->save();

        Event::updateTargetStores($id, $request);
        return;

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
                        ->get();
      return $events;
    }

}

