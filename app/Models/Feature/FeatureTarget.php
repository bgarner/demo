<?php

namespace App\Models\Feature;

use Illuminate\Database\Eloquent\Model;
use App\Models\Utility\Utility;
use App\Models\Feature\Feature;

class FeatureTarget extends Model
{
    protected $table = 'feature_target';
    protected $fillable = ['feature_id', 'store_id'];

    public static function updateFeatureTarget($id, $request)
    {
        $all_stores = $request['all_stores'];

        $feature = Feature::find($id);
        if(FeatureBanner::where('feature_id', $id)->exists()){
            FeatureBanner::where('feature_id', $id)->delete();    
        }

        if( FeatureTarget::where('feature_id', $id)->exists()){
            FeatureTarget::where('feature_id', $id)->delete(); 
        }

        if( FeatureStoreGroup::where('feature_id', $id)->exists()){
            FeatureStoreGroup::where('feature_id', $id)->delete(); 
        }
        
        if( $all_stores == 'on' ){

            $target_banners = $request['target_banners'];
            \Log::info($target_banners);
            if(! is_array($target_banners) ) {
                $target_banners = explode(',',  $request['target_banners'] );    
            }
            foreach ($target_banners as $key=>$banner) {
                FeatureBanner::create([
                'feature_id' => $id,
                'banner_id' => $banner
                ]);
            }
            
            $feature->all_stores = 1;
            $feature->save();
        }
        
        if (isset($request['target_stores']) && $request['target_stores'] != '' ) {
                
            $target_stores = $request['target_stores'];
            if(! is_array($target_stores) ) {
                $target_stores = explode(',',  $request['target_stores'] );    
            }
            foreach ($target_stores as $store) {
                FeatureTarget::insert([
                    'feature_id' => $id,
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
                FeatureStoreGroup::insert([
                    'feature_id' => $id,
                    'store_group_id' => $group
                    ]);    
            }
            
        }  

        Utility::addHeadOffice($id, 'feature_target', 'feature_id');
        
        return;
    }
}
