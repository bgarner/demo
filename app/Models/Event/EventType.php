<?php

namespace App\Models\Event;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Validation\EventTypeValidator;

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
			'foreground_colour' => $request['foreground_colour'],
            'banner_id' => $request['banner_id']
        );

        $eventType = EventType::create($eventTypeDetails);
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

        return $eventType;
    }
}
