<?php

namespace App\Models\Communication;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\StoreApi\StoreInfo;

class CommunicationType extends Model
{
	use SoftDeletes;
    protected $table = 'communication_types';
    protected $dates = ['deleted_at'];
    protected $fillable = ['communication_type', 'banner_id', 'colour'];

    
    public static function getCommunicationTypesByStoreNumber($request, $storeNumber)
    {
        $storeInfo = StoreInfo::getStoreInfoByStoreId($storeNumber);
        $storeBanner = $storeInfo->banner_id;

        if (isset($request['archives']) && $request['archives']) {
            return CommunicationType::getCommunicationTypeCountAllMessages($storeNumber, $storeBanner);
        }
        else{
            return CommunicationType::getCommunicationTypeCount($storeNumber, $storeBanner);
        }

    }
    public static function getCommunicationTypeCount($storeNumber, $storeBanner)
    {
    	$communicationTypes = CommunicationType::where('banner_id', $storeBanner)->get();
    	foreach($communicationTypes as $key=>$ct){

            $count = Communication::getActiveCommunicationCountByCategory($storeNumber, $ct->id);
            if($count > 0) {
                $ct->count = $count;
            }
            else{
                $communicationTypes->forget($key);
            }
        }
        return $communicationTypes;	
    }

    public static function getCommunicationTypeCountAllMessages($storeNumber, $storeBanner)
    {
        $communicationTypes = CommunicationType::where('banner_id', $storeBanner)->get();
         foreach($communicationTypes as $key=>$ct){
            $count = Communication::getAllCommunicationCountByCategory($storeNumber, $ct->id);
            if($count > 0) {
                $ct->count = $count;
            }
            else{
                $communicationTypes->forget($key);
            }
        }
        return $communicationTypes; 
    } 

    public static function isValidCommunicationType($id)
    {
        if(isset($id) && !empty($id) && CommunicationType::find($id)){
            return true;
        }
        else{
            return false;
        }
    }   
}
