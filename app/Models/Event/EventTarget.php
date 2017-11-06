<?php

namespace App\Models\Event;

use Illuminate\Database\Eloquent\Model;
use App\Models\Utility\Utility;
use App\Models\EventStoreGroup;

class EventTarget extends Model
{
    protected $table = 'events_target';
    protected $fillable = ['event_id', 'store_id'];

    public static function updateTargetStores($id, $request)
    {

        $all_stores = $request['all_stores'];

        $event = Event::find($id);
        if(EventBanner::where('event_id', $id)->exists()){
            EventBanner::where('event_id', $id)->delete();    
        }

        if( EventTarget::where('event_id', $id)->exists()){
            EventTarget::where('event_id', $id)->delete(); 
        }

        if( EventStoreGroup::where('event_id', $id)->exists()){
            EventStoreGroup::where('event_id', $id)->delete(); 
        }
        
        if( $all_stores == 'on' ){

            $target_banners = $request['target_banners'];
            \Log::info($target_banners);
            if(! is_array($target_banners) ) {
                $target_banners = explode(',',  $request['target_banners'] );    
            }
            foreach ($target_banners as $key=>$banner) {
                EventBanner::create([
                'event_id' => $id,
                'banner_id' => $banner
                ]);
            }
            
            $event->all_stores = 1;
            $event->save();
        }
        
        if (isset($request['target_stores']) && $request['target_stores'] != '' ) {
                
            $target_stores = $request['target_stores'];
            if(! is_array($target_stores) ) {
                $target_stores = explode(',',  $request['target_stores'] );    
            }
            foreach ($target_stores as $store) {
                EventTarget::insert([
                    'event_id' => $id,
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
                EventStoreGroup::insert([
                    'event_id' => $id,
                    'store_group_id' => $group
                    ]);    
            }
            
        }  
        Utility::addHeadOffice($id, 'events_target', 'event_id');
        return; 
    }
}
