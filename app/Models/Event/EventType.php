<?php

namespace App\Models\Event;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Validation\EventTypeValidator;
use App\Models\Auth\User\UserBanner;
use App\Models\StoreApi\Banner;
use App\Models\Event\EventTypeBanner;

class EventType extends Model
{
	use SoftDeletes;
    protected $table = 'event_types';
    protected $dates = ['deleted_at'];
    protected $fillable = ['event_type', 'background_colour', 'foreground_colour', 'banner_id'];

    public static function validateEventType($request)
    {
    	$validateThis = [
    						'event_type' => $request['event_type']
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
		$event_type = EventType::where("event_type", $name)
								->where("banner_id", $banner)
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

    public static function getEventTypesForAdmin()
    {
        $banners = UserBanner::getAllBanners()->pluck('id')->toArray();
        
        $eventTypes = EventType::join('event_type_banner', 'event_type_banner.event_type_id', '=', 'event_types.id')
                ->whereIn('event_type_banner.banner_id', $banners)
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


}
