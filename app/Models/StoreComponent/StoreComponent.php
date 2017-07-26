<?php

namespace App\Models\StoreComponent;

use Illuminate\Database\Eloquent\Model;
use App\Models\Auth\User\UserSelectedBanner;

class StoreComponent extends Model
{
    protected $table = 'store_components';

    protected $fillable = ['config'];

    
    public static function getComponentDetailsByBanner()
    {
        $banner_id = UserSelectedBanner::getBanner()->id;
        return Self::where('banner_id', $banner_id)
        			->get()
                    ->each(function($component){
                        $component->roles = RoleComponent::getRoleNameListByComponentId($component->id);
                	});
    
    }

}
