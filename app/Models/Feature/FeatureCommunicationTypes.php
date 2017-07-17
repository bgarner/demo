<?php

namespace App\Models\Feature;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class FeatureCommunicationTypes extends Model
{
    use SoftDeletes;
    protected $table  = 'feature_communication_types';
    protected $fillable = ['communication_type_id', 'feature_id'];
    protected $dates = ['deleted_at'];

    public static function getCommunicationTypeId( $featureId )
    {
    	$feature = FeatureCommunicationTypes::where('feature_id', $featureId)->get()->pluck('communication_type_id')->toArray();
    	
        return $feature;
    	
    }
}
