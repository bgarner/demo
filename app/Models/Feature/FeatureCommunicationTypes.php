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
    	$communicationTypes = FeatureCommunicationTypes::where('feature_id', $featureId)->get()->pluck('communication_type_id')->toArray();
    	
        return $communicationTypes;
    	
    }

    public static function updateCommunicationTypes($communication_types, $feature_id)
    {
        if(FeatureCommunicationTypes::where('feature_id', $feature_id)->first()){
            $feature = FeatureCommunicationTypes::where('feature_id', $feature_id)->delete();
        }
        if (isset($communication_types)) {   
            
            foreach ($communication_types as $type) {
                FeatureCommunicationTypes::create([
                    'feature_id' => $feature_id,
                    'communication_type_id' => intval($type)
                    ]);
            }
        }
    }
}
