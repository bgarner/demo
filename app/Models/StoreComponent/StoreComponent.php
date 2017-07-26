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
                        // $component->roles = RoleComponent::getRoleNameListByComponentId($component->id);
                	});
    
    }

}
