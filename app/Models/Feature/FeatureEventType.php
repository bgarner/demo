<?php

namespace App\Models\Feature;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class FeatureEventType extends Model
{
    use SoftDeletes;
    protected $table = 'feature_event_type';
    protected $fillable = ['feature_id', 'event_type_id'];

    public static function getEventTypeId( $featureId )
    {
    	$eventTypes = FeatureEventType::where('feature_id', $featureId)->get()->pluck('event_type_id')->toArray();
    	
        return $eventTypes;
    	
    }

    public static function updateEventTypes($event_types, $feature_id)
    {
        if(FeatureEventType::where('feature_id', $feature_id)->first()){
            $feature = FeatureEventType::where('feature_id', $feature_id)->delete();
        }
        if (isset($event_types)) {   
            
            foreach ($event_types as $type) {
                FeatureEventType::create([
                    'feature_id' => $feature_id,
                    'event_type_id' => intval($type)
                    ]);
            }
        }
    }

}
