<?php

namespace App\Models\StoreComponent;

use Illuminate\Database\Eloquent\Model;
use App\Models\Auth\User\UserSelectedBanner;
use App\Models\Auth\Role\RoleComponent;

class StoreComponent extends Model
{
    protected $table = 'store_components';

    protected $fillable = ['component_name', 'component_label',  'config', 'banner_id'];

    
    public static function getComponentDetailsByBanner()
    {
        $banner_id = UserSelectedBanner::getBanner()->id;
        return Self::where('banner_id', $banner_id)
        			->get()
                    ->each(function($component){

                    	if(isset($component->config)){

                    		$config = json_decode($component->config);	
                    		$component->state = $config->state;

                    	}
                        
                	});
    
    }

    public static function updateComponent($request, $id)
    {
    	$component = StoreComponent::find($id);
    	if($request->state == 'on'){
    		$state = 'off';
    	}
    	else{
    		$state = 'on';
    	}
    	$component->update(['config' => json_encode(['state' => $state])]);

    	return $component;
    }

}
