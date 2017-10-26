<?php

namespace App\Models\Communication;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Carbon\Carbon;
use DB; 
use App\Models\Utility\Utility;
use App\Models\StoreApi\StoreInfo;
use App\Models\Communication\Communication;
use App\Models\StoreApi\Banner;

class CommunicationTarget extends Model
{
	protected $table = 'communications_target';
	protected $fillable = ['communication_id', 'store_id', 'is_read'];

    public static function updateTargetStores($id, $request)
    {
        $all_stores = $request['all_stores'];

        $communication = Communication::find($id);
        if(CommunicationBanner::where('communication_id', $id)->exists()){
            CommunicationBanner::where('communication_id', $id)->delete();    
        }

        if( CommunicationTarget::where('communication_id', $id)->exists()){
            CommunicationTarget::where('communication_id', $id)->delete(); 
        }

        if( CommunicationStoreGroup::where('communication_id', $id)->exists()){
            CommunicationStoreGroup::where('communication_id', $id)->delete(); 
        }
        
        if( $all_stores == 'on' ){

            $target_banners = $request['target_banners'];
            \Log::info($target_banners);
            if(! is_array($target_banners) ) {
                $target_banners = explode(',',  $request['target_banners'] );    
            }
            foreach ($target_banners as $key=>$banner) {
                CommunicationBanner::create([
                'communication_id' => $id,
                'banner_id' => $banner
                ]);
            }
            
            $communication->all_stores = 1;
            $communication->save();
        }
        
        if (isset($request['target_stores']) && $request['target_stores'] != '' ) {
                
            $target_stores = $request['target_stores'];
            if(! is_array($target_stores) ) {
                $target_stores = explode(',',  $request['target_stores'] );    
            }
            foreach ($target_stores as $store) {
                CommunicationTarget::insert([
                    'communication_id' => $id,
                    'store_id' => $store
                    ]);    
            }
        }  
        if (isset($request['store_groups']) && $request['store_groups'] != '' ) {
                
            $store_groups = $request['store_groups'];
            if(! is_array($store_groups) ) {
                $store_groups = explode(',',  $request['store_groups'] );    
            }
            foreach ($store_groups as $group) {
                CommunicationStoreGroup::insert([
                    'communication_id' => $id,
                    'store_group_id' => $group
                    ]);    
            }
            
        }  
        Utility::addHeadOffice($id, 'communications_target', 'communication_id');
        return; 
    }

    public function getTargetStores($id)
    {
        $communication = Communication::find($id);

        if(isset($communication->all_stores) && $communication->all_stores){
            
            $banners = CommunicationBanner::where('communication_id', $communication->id)->get()->pluck('banner_id')->toArray();
            $stores = [];
            foreach ($banners as $banner) {
                $bannerStores = Banner::getStoreDetailsByBannerid($banner)->pluck('store_number')->toArray();   
                $stores = array_merge($stores, $bannerStores);

            }
        }
        else{
            $stores = CommunicationTarget::where('communication_id', $id)
                                            ->get()
                                            ->pluck('store_id')
                                            ->toArray();    
        }

        return $stores;
        
                                            
    }

}
