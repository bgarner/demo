<?php

namespace App\Models\Feature;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class FeatureCommunication extends Model
{
    use SoftDeletes;
    protected $table  = 'feature_communications';
    protected $fillable = ['communication_id', 'feature_id'];
    protected $dates = ['deleted_at'];

    public static function updateFeatureCommunications($communications, $feature_id)
    {
        if(FeatureCommunication::where('feature_id', $feature_id)->first()){
            $feature = FeatureCommunication::where('feature_id', $feature_id)->delete();
        }
        if(isset($communications)){
            foreach ($communications as $comm) {
                FeatureCommunication::create([
                    'communication_id' => $comm,
                    'feature_id'       => $feature_id
                ]);
            }
        }
        
        return;
        
    }

    public static function getCommunicationId($feature_id)
    {
        $communications = FeatureCommunication::where('feature_id', $feature_id)->get()->pluck('communication_id')->toArray();
        return $communications;
    }
}
