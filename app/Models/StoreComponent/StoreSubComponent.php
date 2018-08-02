<?php

namespace App\Models\StoreComponent;

use Illuminate\Database\Eloquent\Model;
use App\Models\StoreApi\StoreInfo;

class StoreSubComponent extends Model
{
    protected $table = 'store_components_subcomponents';

    protected $fillable = [ 'parent_component_id', 'subcomponent_name', 'subcomponent_label',  'config', 'banner_id'];

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
