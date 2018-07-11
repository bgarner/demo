<?php 

namespace App\Models\StoreApi;

use Illuminate\Database\Eloquent\Model;
use App\Models\Auth\Resource\Resource;
use App\Models\Auth\User\UserResource;

class Region extends Model {

    protected $fillable = [];

    protected $dates = [];

    public static $rules = [
        // Validation rules
    ];

    protected static $resource_type_id = 3; 

    public static function getAllRegions()
    {
    	$regions = Region::all()
    					->each(function($region){
    						$region->districts = District::getDistrictDetailsByRegionId($region->id);
                            $resource_id = Resource::getResourceByResourceTypeIdandResourceId(Self::$resource_type_id, $region->id)->id;
                            $region->avp_details = UserResource::getUserByResourceId($resource_id);

    					});
    	if(count($regions)>0){
    		return $regions;
    	}
    	return $regions;

    }
    public static function getRegionDetailsByDistrictId($id)
    {
    	$region = Region::find($id);
    	$region->districts = District::getDistrictDetailsByRegionId($id);
    					
    	if(count($region)>0){
    		return $region;
    	}
    	return $region;
    }

}
