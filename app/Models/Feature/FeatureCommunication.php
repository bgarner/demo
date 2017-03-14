<?php

namespace App\Models\Feature;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class FeatureCommunication extends Model
{
    use SoftDeletes;
    protected $table  = 'communication_types_features';
    protected $fillable = ['communication_type_id', 'feature_id'];
    protected $dates = ['deleted_at'];

    public static function getCommunicationTypeId( $featureId )
    {
    	$feature = FeatureCommunication::where('feature_id', $featureId)->get()->pluck('communication_type_id');
    	
        if(count($feature) > 0){
            return $feature[0];    
        } else {
            return 0;
        }
    	
    }
}
