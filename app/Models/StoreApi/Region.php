<?php 

namespace App\Models\StoreApi;

use Illuminate\Database\Eloquent\Model;

class Region extends Model {

    protected $fillable = [];

    protected $dates = [];

    public static $rules = [
        // Validation rules
    ];

    public static function getAllRegions()
    {
    	$regions = Region::all()
    					->each(function($region){
    						$region->districts = District::getDistrictDetailsByRegionId($region->id);
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
