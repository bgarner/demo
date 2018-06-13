<?php

namespace App\Models\Feature;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Communication\Communication;
use Illuminate\Database\Eloquent\Collection as Collection;

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

    public static function getFeatureCommunications($feature_id, $storeNumber)
    {
        $featureCommunicationTypes = FeatureCommunicationTypes::getCommunicationTypeId($feature_id);

        $mergedCommunications = new Collection();

        foreach ($featureCommunicationTypes as $type) {
            $communications  = Communication::getActiveCommunicationsByCategory($storeNumber, $type);

            $mergedCommunications = $communications->merge($mergedCommunications);
        }

        $featureCommunications = FeatureCommunication::getCommunicationId($feature_id);
        foreach ($featureCommunications as $comm) {
            $communications = Communication::getCommunicationById($comm);
            $mergedCommunications->push($communications);
        }

        return $mergedCommunications;
    }

    public static function getFeatureCommunicationsForStoreList($storeList,  $banners, $storeGroups, $feature_id)
    {
        $featureCommunicationTypes = FeatureCommunicationTypes::getCommunicationTypeId($feature_id);

        $mergedCommunications = new Collection();

        foreach ($featureCommunicationTypes as $type) {
            $communications  = Communication::getCommunicationsByTypeForStoreList($storeList, $banners, $storeGroups, $type);
            dd($communications);
            $mergedCommunications = $communications->merge($mergedCommunications);
        }

        $featureCommunications = FeatureCommunication::getCommunicationId($feature_id);
        foreach ($featureCommunications as $comm) {
            $communications = Communication::getCommunicationById($comm);
            $mergedCommunications->push($communications);
        }

        return $mergedCommunications;
    }
}
