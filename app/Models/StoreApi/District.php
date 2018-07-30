<?php 

namespace App\Models\StoreApi;

use Illuminate\Database\Eloquent\Model;
use App\Models\Auth\Resource\ResourceTypes;
use App\Models\Auth\Resource\Resource;
use App\Models\Auth\User\UserResource;

class District extends Model {

    protected $table = 'districts';
    protected $fillable = ['name'];

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

    public static function createDistrict($request)
    {
        $district = District::create([
            'name' => $request->district_name
        ]);

        RegionDistrict::updateRegionDistrictPivot($district->id, $request->region);
        DistrictStore::updateDistrictStorePivot($request->stores, $district->id);
        Resource::createResource( [ 'resource_type' => Self::$resource_type_id , 
                                    'resource_id' => $district->id] );

        return $district;
    }

    public static function updateDistrict($id, $request)
    {
        return District::find($id)->update(['name'=> $request->district_name]);
    }

    public static function deleteDistrict($id)
    {
        $storesInDistrict = DistrictStore::where('district_id', $id)->count();
        if($storesInDistrict > 0) {
            return json_encode(['success'=>'false', 'description'=>'District not empty']);
        }

        DistrictStore::where('district_id', $id)->delete();
        RegionDistrict::where('district_id', $id)->delete();
        Resource::where('resource_type_id', Self::$resource_type_id)->where('resource_id', $id)->delete();
        District::find($id)->delete();
        return json_encode(['success'=>'true', 'description'=>'District deleted']);
    }

    

}
