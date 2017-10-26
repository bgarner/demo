<?php

namespace App\Models\Feature;

use Illuminate\Database\Eloquent\Model;

class FeatureEvent extends Model
{
    protected $table = 'feature_event';
    protected $fillable = ['feature_id', 'event_id'];

    public static function getEventsId($feature_id)
    {

    }

    public static function updateFeatureEvent($events, $feature_id)
    {

    }

    public static function getFeatureEvents($feature_id)
    {
    	
    }
}
