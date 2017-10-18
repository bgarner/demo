<?php

namespace App\Models\UrgentNotice;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\StoreApi\Banner;
use App\Models\UrgentNotice\UrgentNoticeBanner;
class UrgentNoticeTarget extends Model
{
	use SoftDeletes;
    protected $table = 'urgent_notice_target';

    protected $fillable = ['urgent_notice_id', 'store_id', 'is_read'];
    protected $dates = ['deleted_at'];

    public function getTargetStores($id)
    {
        $urgentnotice = UrgentNotice::find($id);

        if(isset($urgentnotice->all_stores) && $urgentnotice->all_stores){
            $banner = $urgentnotice->banner_id;
            $stores = Banner::getStoreDetailsByBannerid($banner)->pluck('store_number')->toArray();
        }
        else{
            $stores = UrgentNoticeTarget::where('urgent_notice_id', $id)
                                            ->get()
                                            ->pluck('store_id')
                                            ->toArray();    
        }

        return $stores;
        
                                            
    }

    public static function updateTargetStores($request, $id)
    {
        $all_stores = $request['all_stores'];

        $urgentNotice = UrgentNotice::find($id);
        if(UrgentNoticeBanner::where('urgent_notice_id', $id)->exists()){
            UrgentNoticeBanner::where('urgent_notice_id', $id)->delete();    
        }

        if( UrgentNoticeTarget::where('urgent_notice_id', $id)->exists()){
            UrgentNoticeTarget::where('urgent_notice_id', $id)->delete(); 
        }

        if( UrgentNoticeStoreGroup::where('urgent_notice_id', $id)->exists()){
            UrgentNoticeStoreGroup::where('urgent_notice_id', $id)->delete(); 
        }
        
        if( $all_stores == 'on' ){

            $target_banners = $request['target_banners'];
            \Log::info($target_banners);
            if(! is_array($target_banners) ) {
                $target_banners = explode(',',  $request['target_banners'] );    
            }
            foreach ($target_banners as $key=>$banner) {
                UrgentNoticeBanner::create([
                'urgent_notice_id' => $id,
                'banner_id' => $banner
                ]);
            }
            
            $urgentNotice->all_stores = 1;
            $urgentNotice->save();
        }
        
        if (isset($request['target_stores']) && $request['target_stores'] != '' ) {
                
            $target_stores = $request['target_stores'];
            if(! is_array($target_stores) ) {
                $target_stores = explode(',',  $request['target_stores'] );    
            }
            foreach ($target_stores as $store) {
                UrgentNoticeTarget::insert([
                    'urgent_notice_id' => $id,
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
                UrgentNoticeStoreGroup::insert([
                    'urgent_notice_id' => $id,
                    'store_group_id' => $group
                    ]);    
            }
            
        }  
        Utility::addHeadOffice($id, 'urgent_notice_target', 'urgent_notice_id');
        return;      
    } 
}
