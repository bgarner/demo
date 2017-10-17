<?php

namespace App\Models\Communication;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\StoreApi\StoreInfo;
use App\Models\Auth\User\UserBanner;
use App\Models\StoreApi\Banner;
use App\Models\Communication\CommunicationTypeBanner;
use App\Models\Tools\CustomStoreGroup;
use App\Models\StoreApi\Store;

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

    public static function getCommunicationTypesForAdmin()
    {
        $banners = UserBanner::getAllBanners()->pluck('id')->toArray();
        
        $communicationTypes = CommunicationType::join('communication_type_banner', 'communication_type_banner.communication_type_id', '=', 'communication_types.id')
                ->whereIn('communication_type_banner.banner_id', $banners)
                ->select(\DB::raw('
                    communication_types.id as id,
                    communication_types.communication_type,
                    communication_types.colour, 
                    GROUP_CONCAT(DISTINCT communication_type_banner.banner_id) as banners'))
                ->groupBy('communication_type_banner.communication_type_id')
                ->get()
                ->each(function($item){
                    $banner_ids = explode(',', $item->banners);
                    $item->banners = Banner::whereIn('id', $banner_ids)->get();

                });
        return $communicationTypes;
        

    }
    public static function getCommunicationTypeById($id)
    {
        $commType = CommunicationType::join('communication_type_banner', 'communication_type_banner.communication_type_id', '=', 'communication_types.id')
                ->where('communication_types.id', $id)
                ->select(\DB::raw('
                    communication_types.id as id,
                    communication_types.communication_type,
                    communication_types.colour, 
                    GROUP_CONCAT(DISTINCT communication_type_banner.banner_id) as banners'))
                ->groupBy('communication_type_banner.communication_type_id')
                ->first();

        $banner_ids = explode(',', $commType->banners);
        $commType->banners = Banner::whereIn('id', $banner_ids)->get()->pluck('id')->toArray();

        return $commType;

                
    }

    public static function updateCommunicationType($id, $request)
    {
        $commType = CommunicationType::find($id); 
        $commType->communication_type = $request->communication_type;
        $commType->colour = $request->colour;
        $commType->save();
        
        if(isset($request->banners)){
            CommunicationTypeBanner::where('communication_type_id', $id)->delete();
            foreach($request->banners as $banner){
                CommunicationTypeBanner::create([
                    'communication_type_id' => $id,
                    'banner_id' => $banner
                ]);
            }    
        }
        
        return $commType;
    }

    public static function storeCommunicationType($request)
    {
        $communicationTypeDetails = array(
            'communication_type' => $request['communication_type'],
            'colour' => $request['colour'],
            'banner_id' => 1
        );

        $communicationType = CommunicationType::create($communicationTypeDetails);

        if(isset($request->banners)){
            foreach($request->banners as $banner){
                CommunicationTypeBanner::create([
                    'communication_type_id' => $communicationType->id,
                    'banner_id' => $banner
                ]);
            }
        }
          
        return $communicationType;
    }

    public static function getCommunicationTypesByTarget($request)
    {
        $targetStores = collect();
        $banners = collect();

        if(isset($request->store_groups)){
            $storeGroups = $request->store_groups;
                
            foreach ($storeGroups as $group) {
                $groupDetails = CustomStoreGroup::find($group);
                $stores = unserialize($groupDetails->stores);
                $targetStores = $targetStores->merge($stores);
            }
        }
        if(isset($request->target_stores)){

            $targetStores = $targetStores->merge($request->target_stores);
        }

        if(count($targetStores)>0){
            $allStores = Store::getAllStores()->pluck('banner_id','store_number')->toArray();
            foreach ($targetStores as $store) {
                if(array_key_exists($store, $allStores)){
                    $banners->push($allStores[$store]);
                }
            }    
        }
        

        if(isset($request->target_banners)){

            $banners = $banners->merge($request->target_banners);
            $banners = $banners->unique();
        }


        $communicationTypes = CommunicationType::join('communication_type_banner', 'communication_type_banner.communication_type_id', '=', 'communication_types.id')
                                                ->whereIn('communication_type_banner.banner_id', $banners)
                                                ->where('deleted_at', null)
                                                ->select('communication_types.*')
                                                ->get();
        return $communicationTypes;
    }
}
