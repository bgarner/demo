<?php

namespace App\Models\Feature;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class FeatureEvent extends Model
{
    use SoftDeletes;
    protected $table = 'feature_event';
    protected $fillable = ['feature_id', 'event_id'];

    public static function getEventId($feature_id)
    {
        $events = FeatureEvent::where('feature_id', $feature_id)->get()->pluck('event_id')->toArray();
        return $events;
    }

    public static function updateFeatureEvents($events, $feature_id)
    {

        if(FeatureEvent::where('feature_id', $feature_id)->first()){
            $feature = FeatureEvent::where('feature_id', $feature_id)->delete();
        }
        if (isset($events)) {   
            
            foreach ($events as $event) {
                FeatureEvent::create([
                    'feature_id' => $feature_id,
                    'event_id' => intval($event)
                    ]);
            }
        }
    }

    public static function getEventsByFeatureId($feature_id)
    {
    	$feature = Feature::find($feature_id);
        
        $featureEvents =  FeatureEventType::join('events', 'events.event_type', '=', 'feature_event_type.event_type_id' )
                                        ->where('feature_id', $feature_id)
                                        ->where('events.start', '<', $feature->end)
                                        ->where('events.end', '>', $feature->start)
                                        ->select('events.*')
                                        ->get();
        
        return $featureEvents;
    }
}
