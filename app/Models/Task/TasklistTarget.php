<?php

namespace App\Models\Task;

use Illuminate\Database\Eloquent\Model;
use App\Models\Utility\Utility;
use App\Models\StoreApi\Banner;

class TasklistTarget extends Model
{
    protected $table = 'tasklist_target';

    protected $fillable = ['tasklist_id', 'store_id'];

    public static function updateTargetStores($id, $request)
	{	
		$all_stores = $request['all_stores'];

        $tasklist = Tasklist::find($id);
        if(TasklistBanner::where('tasklist_id', $id)->exists()){
            TasklistBanner::where('tasklist_id', $id)->delete();    
        }

        if( TasklistTarget::where('tasklist_id', $id)->exists()){
            TasklistTarget::where('tasklist_id', $id)->delete(); 
        }

        if( TasklistStoreGroup::where('tasklist_id', $id)->exists()){
            TasklistStoreGroup::where('tasklist_id', $id)->delete(); 
        }
        
        if( $all_stores == 'on' ){
            $tasklist->all_stores = 1;
            $tasklist->save();
            $target_banners = $request['target_banners'];
            if(! is_array($target_banners) ) {
                $target_banners = explode(',',  $request['target_banners'] );    
            }
            
            foreach ($target_banners as $key=>$banner) {
                TasklistBanner::create([
                'tasklist_id' => $id,
                'banner_id' => $banner
                ]);
            }
        }
        if (isset($request['target_stores']) && $request['target_stores'] != '' ) {
                
            $target_stores = $request['target_stores'];
            if(! is_array($target_stores) ) {
                $target_stores = explode(',',  $request['target_stores'] );    
            }
            foreach ($target_stores as $store) {
                TasklistTarget::insert([
                    'tasklist_id' => $id,
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
                TasklistStoreGroup::insert([
                    'tasklist_id' => $id,
                    'store_group_id' => $group
                    ]);    
            }
            
        } 
        Utility::addHeadOffice($id, 'tasklist_target', 'tasklist_id');

        return; 

	}

	public static function getTargetStoresByTasklistId($id)
	{
		$tasklist = Tasklist::find($id);

        if(isset($tasklist->all_stores) && $tasklist->all_stores){
            $banner = 1;
            $stores = Banner::getStoreDetailsByBannerid($banner)->pluck('store_number')->toArray();
        }
        else{
            $stores = TasklistTarget::where('tasklist_id', $id)
                                ->get()
                                ->pluck('store_id')
                                ->toArray();    
        }


        return $stores;
	}
}
