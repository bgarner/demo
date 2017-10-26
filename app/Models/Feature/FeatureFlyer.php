<?php

namespace App\Models\Feature;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Utility\Utility;

class FeatureFlyer extends Model
{
    use SoftDeletes;
    protected $table = 'feature_flyer';
    protected $fillable = ['feature_id', 'flyer_id'];

    public static function updateFeatureFlyer($flyers, $feature_id)
    {
        if( FeatureFlyer::where('feature_id', $feature_id)->exists()){
            FeatureFlyer::where('feature_id', $feature_id)->delete(); 
        }
        if (isset($flyers) && $flyers != '' ) {
                
            if(! is_array($flyers) ) {
                $flyers = explode(',',  $flyers );    
            }
            foreach ($flyers as $flyer) {
                FeatureFlyer::insert([
                    'feature_id' => $feature_id,
                    'flyer_id'   => $flyer
                    ]);    
            }
            
        }  
    }
    public static function getFlyersByFeatureId($feature_id)
    {
        return Self::join('flyers', 'feature_flyer.flyer_id', '=', 'flyers.id')
                    ->where('feature_id', $feature_id)
                    ->select('flyers.*')
                    ->get()
                    ->each(function($flyer){
                        $flyer->pretty_start_date = Utility::prettifyDate($flyer->start_date);
                        $flyer->pretty_end_date = Utility::prettifyDate($flyer->end_date);
                    });
    }
}
