<?php

namespace App\Models\Feature;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Feature\FeatureEventType;
use App\Models\Utility\Utility;
use Carbon\Carbon;

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
        
        $featureEventsByType =  FeatureEventType::join('events', 'events.event_type', '=', 'feature_event_type.event_type_id' )
                                        ->where('feature_id', $feature_id)
                                        ->where('events.start', '<', $feature->end)
                                        ->where('events.end', '>', $feature->start)
                                        ->where('events.start', '>', now())
                                        ->select('events.*')
                                        ->get();

        $featureEvents = FeatureEvent::join('events', 'events.id' , '=', 'feature_event.event_id')
                                    ->where('feature_id', $feature_id)
                                    ->where('events.start', '<', $feature->end)
                                    ->where('events.end', '>', $feature->start)
                                    ->where('events.start', '>', now())
                                    ->select('events.*')
                                    ->get();
        $featureEvents = $featureEventsByType->merge($featureEvents)->sortBy('start');

        foreach($featureEvents as $fe){
            $dt = Carbon::parse($fe->start);
            $fe->monthName = Utility::getMonthName($dt->month);
            $fe->dayName = Utility::getDayName($dt->month, $dt->day);
            $fe->day = $dt->day;
        }
        return $featureEvents;
    }
}
