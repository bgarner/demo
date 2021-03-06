<?php

namespace App\Models\Event;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Validation\EventTypeValidator;
use App\Models\Auth\User\UserBanner;
use App\Models\StoreApi\Banner;
use App\Models\Event\EventTypeBanner;
use App\Models\StoreApi\Store;
use App\Models\Utility\Utility;
use App\Models\Auth\User\UserSelectedBanner;

class EventType extends Model
{
    use SoftDeletes;
    protected $table = 'event_types';
    protected $dates = ['deleted_at'];
    protected $fillable = ['event_type', 'background_colour', 'foreground_colour', 'banner_id'];

    public static function validateEventType($request)
    {
        $validateThis = [
                            'event_type' => $request['event_type'],
                            'banners'    => $request['banners']
                        ];

        $v = new EventTypeValidator();
        return $v->validate($validateThis);
    }

    public static function getName($id)
    {
        $event_type = EventType::find($id);
        return $event_type->event_type;
    }

    public static function getBackground($id)
    {
        $event_type = EventType::find($id);
        return $event_type->background_colour;
    }

	public static function getForeground($id)
	{
        $event_type = EventType::find($id);
        return $event_type->foreground_colour;
    }

    public static function getEventTypeIdByName($name, $banner)
    {
        $event_type = EventType::join('event_type_banner', 'event_type_banner.event_type_id', '=', 'event_types.id')
                                ->where("event_type", $name)
                                ->where("banner_id", $banner)
                                ->select('event_types.*')
                                ->first();
        return $event_type->id;
	}

    public static function getEventTypeListByBannerId($banner_id)
    {
        return  EventType::where('banner_id', $banner_id)
                                    ->pluck('event_type', 'id')
                                    ->prepend('Select one', '')
                                    ->toArray();
    }

    public static function createEventType($request)
    {
        $validate = EventType::validateEventType($request);

        if($validate['validation_result'] == 'false') {
          \Log::info($validate);
          return json_encode($validate);
        }

        $eventTypeDetails = array(
            'event_type' => $request['event_type'],
            'background_colour' => $request['background_colour'],
            'foreground_colour' => $request['foreground_colour']
        );

        $eventType = EventType::create($eventTypeDetails);

        if(isset($request->banners)){
            foreach($request->banners as $banner){
                EventTypeBanner::create([
                    'event_type_id' => $eventType->id,
                    'banner_id' => $banner
                ]);
            }
        }


        return $eventType;
    }

    public static function updateEventType($id, $request)
    {
        $validate = EventType::validateEventType($request);

        if($validate['validation_result'] == 'false') {
          \Log::info($validate);
          return json_encode($validate);
        }

        $eventType =  EventType::find($id);

        $eventType->event_type = $request['event_type'];
        $eventType->background_colour = $request['background_colour'];
        $eventType->foreground_colour = $request['foreground_colour'];

        $eventType->save();

        if(isset($request->banners)){
            EventTypeBanner::where('event_type_id', $id)->delete();
            foreach($request->banners as $banner){
                EventTypeBanner::create([
                    'event_type_id' => $id,
                    'banner_id' => $banner
                ]);
            }    
        }

        return $eventType;
    }

    public static function deleteEventType($id)
    {
        $events = Event::where("event_type", $id)->get();
        //if yes, return message
        if(count($events) > 0){
            //we have events
            $result = [
                "success" => false
            ];
            return json_encode($result);
        } else {
            Self::find($id)->delete();
            $result = [
                "success" => true
            ];

            return json_encode($result);
        }

    }

    public static function getEventTypesForAdmin()
    {
        $banner = UserSelectedBanner::getBanner()->id;
        
        $eventTypes = EventType::join('event_type_banner', 'event_type_banner.event_type_id', '=', 'event_types.id')
                ->where('event_type_banner.banner_id', $banner)
                ->select(\DB::raw('
                    event_types.id as id,
                    event_types.event_type,
                    event_types.background_colour,
                    event_types.foreground_colour, 
                    GROUP_CONCAT(DISTINCT event_type_banner.banner_id) as banners'))
                ->groupBy('event_type_banner.event_type_id')
                ->get()
                ->each(function($item){
                    $banner_ids = explode(',', $item->banners);
                    $item->banners = Banner::whereIn('id', $banner_ids)->get();

                });
        return $eventTypes;
        

    }

    public static function getEventTypeById($id)
    {
        $eventType = EventType::join('event_type_banner', 'event_type_banner.event_type_id', '=', 'event_types.id')
                ->where('event_types.id', $id)
                ->select(\DB::raw('
                    event_types.id as id,
                    event_types.event_type,
                    event_types.background_colour,
                    event_types.foreground_colour,
                    GROUP_CONCAT(DISTINCT event_type_banner.banner_id) as banners'))
                ->groupBy('event_type_banner.event_type_id')
                ->first();

        $banner_ids = explode(',', $eventType->banners);
        $eventType->banners = Banner::whereIn('id', $banner_ids)->get()->pluck('id')->toArray();

        return $eventType;
                
    }
    public static function getEventTypesByTarget($request)
    {

        $banners = Utility::getUniqueBannersForTarget($request);
        $eventTypes = collect();

        if(count($banners)>1){
            $eventTypes = EventType::join('event_type_banner', 'event_type_banner.event_type_id', '=', 'event_types.id')
                                    ->where('deleted_at', null)
                                    ->select(\DB::raw('event_types.*, GROUP_CONCAT(DISTINCT event_type_banner.banner_id Order By event_type_banner.banner_id ) as banners'))
                                    ->groupBy('event_type_banner.event_type_id')
                                    ->get();
                                    
            foreach ($eventTypes as $key => $type) {  
                $typeBanners = explode(',', $type->banners);
                if($typeBanners != $banners){ //for arrays to be equal, they must have same key/value pairs.
                                                // if $type->banners is not in the same order as $banners, it
                                                //returns false
            
                    $eventTypes->forget($key);
                }
            }
           
        }

        if(count($banners) == 1){
            $eventTypes = EventType::join('event_type_banner', 'event_type_banner.event_type_id', '=', 'event_types.id')
                                    ->where('deleted_at', null)
                                    ->whereIn('event_type_banner.banner_id', $banners)
                                    ->select('event_types.*')
                                    ->groupBy('event_type_banner.event_type_id')
                                    ->get();
        }
        return $eventTypes->pluck('event_type', 'id')->toArray();
    }


}
