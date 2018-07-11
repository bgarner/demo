<?php 

namespace App\Models\StoreApi;

use Illuminate\Database\Eloquent\Model;
use App\Models\Auth\Resource\ResourceTypes;
use App\Models\Auth\Resource\Resource;
use App\Models\Auth\User\UserResource;

class District extends Model {

    protected $fillable = [];

    protected $dates = [];

    public static $rules = [
        // Validation rules
    ];

    protected $resource_type = 'district';
    protected static $resource_type_id = 2; 

    public static function getAllDistricts()
    {
    	$districts = District::all()
    						->each(function($district){
    							$district->stores = Store::getStoreDetailsByDistrictId($district->id);
                                $resource_id = Resource::getResourceByResourceTypeIdandResourceId(Self::$resource_type_id, $district->id)->id;
                                $district->dm_details = UserResource::getUserByResourceId($resource_id);
                                
    						});
    						
    	if(count($districts)>0){
    		return $districts;
    	}
    	return [];
    }

    public static function getDistrictDetailsByDistrictId($id)
    {
    	$district = District::find($id);
		$district->stores = Store::getStoreDetailsByDistrictId($id);
    	if(count($district)>0){
    		return $district;
    	}
    	return [];
    }
    public static function getDistrictDetailsByRegionId($id)
    {
        $districts = District::join('district_region', 'district_region.district_id', '=', 'districts.id')
					                ->where('district_region.region_id', $id)
					                ->select('districts.*')
					                ->get()
					                ->each(function($district){
    									$district->stores = Store::getStoreDetailsByDistrictId($district->id);
    								});

        if(count($districts)>0){
    		return $districts;
    	}
    	return [];
    } 

    

}
