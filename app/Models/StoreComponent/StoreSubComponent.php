<?php

namespace App\Models\StoreComponent;

use Illuminate\Database\Eloquent\Model;
use App\Models\StoreApi\StoreInfo;
use App\Models\Auth\User\UserSelectedBanner;

class StoreSubComponent extends Model
{
    protected $table = 'store_components_subcomponents';

    protected $fillable = [ 'parent_component_id', 'subcomponent_name', 'subcomponent_label',  'config', 'banner_id'];

    public static function getSubcomponentsByParentId($parent_component_id)
    {
        $banner_id = UserSelectedBanner::getBanner()->id;
        $subComponent =  Self::where('parent_component_id', $parent_component_id)
                            ->get()
                            ->each(function($component){
                                if(isset($component->config)){
                                    $config = json_decode($component->config);  
                                    $component->state = $config->state;
                                }                        
                            });
        return($subComponent);
    
    }

    public static function updateComponent($request, $id)
    {
        $component = StoreSubComponent::find($id);
        if($request->state == 'on'){
            $state = 'off';
        }
        else{
            $state = 'on';
        }
        $component->update(['config' => json_encode(['state' => $state])]);

        return $component;
    }

    public static function getComponents($storeNumber)
    {
        $banner_id = StoreInfo::getStoreInfoByStoreId($storeNumber)->banner_id;
        $components =  Self::where('banner_id', $banner_id)
                            ->get();

        $components = $components->each(function($component, $key) use ($components){

                            if(isset($component->config)){
                                $component->config = json_decode($component->config);
                                if($component->config->state == 'off'){
                                    $components->forget($key);
                                }
                            }
                        })
                        ->groupBy('parent_component_id')
                        ->toArray();
        return ($components);
    }
}
