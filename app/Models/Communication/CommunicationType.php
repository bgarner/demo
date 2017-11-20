<?php

namespace App\Models\Communication;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\StoreApi\StoreInfo;
use App\Models\Auth\User\UserBanner;
use App\Models\StoreApi\Banner;
use App\Models\Communication\CommunicationTypeBanner;
use App\Models\Utility\Utility;

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
    	$communicationTypes = CommunicationType::join('communication_type_banner', 'communication_type_banner.communication_type_id', '=', 'communication_types.id')
                                    ->where('communication_type_banner.banner_id', $storeBanner)
                                    ->get();

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
        $communicationTypes = CommunicationType::join( 'communication_type_banner', 'communication_type_banner.communication_type_id', '=', 'communication_types.id')
                                    ->where('communication_type_banner.banner_id', $storeBanner)
                                    ->get();
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
            'colour' => $request['colour']
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
        $banners = Utility::getUniqueBannersForTarget($request);
        $communicationTypes = collect();

        if(count($banners)>1){
            $communicationTypes = CommunicationType::join('communication_type_banner', 'communication_type_banner.communication_type_id', '=', 'communication_types.id')
                                    ->where('deleted_at', null)
                                    ->select(\DB::raw('communication_types.*, GROUP_CONCAT(DISTINCT communication_type_banner.banner_id Order By communication_type_banner.banner_id ) as banners'))
                                    ->groupBy('communication_type_banner.communication_type_id')
                                    ->get();
                                    
            foreach ($communicationTypes as $key => $type) {  
                $typeBanners = explode(',', $type->banners);
                if($typeBanners != $banners){ //for arrays to be equal, they must have same key/value pairs.
                                                // if $type->banners is not in the same order as $banners, it
                                                //returns false
            
                    $communicationTypes->forget($key);
                }
            }
           
        }

        if(count($banners) == 1){
            $communicationTypes = CommunicationType::join('communication_type_banner', 'communication_type_banner.communication_type_id', '=', 'communication_types.id')
                                    ->where('deleted_at', null)
                                    ->whereIn('communication_type_banner.banner_id', $banners)
                                    ->select('communication_types.*')
                                    ->groupBy('communication_type_banner.communication_type_id')
                                    ->get();
        }
        return $communicationTypes;
    }

    public static function deleteCommunicationType($id)
    {
        $communicationsWithType = Communication::where('communication_type_id', $id)->get();
        foreach ($communicationsWithType as $comm) {
            $comm->communication_type_id = 1; //no category
            $comm->save();
        }

        $communicationtype = CommunicationType::find($id);
        $communicationtype->delete();
    }
}
