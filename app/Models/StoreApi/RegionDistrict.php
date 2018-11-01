<?php

namespace App\Models\StoreApi;

use Illuminate\Database\Eloquent\Model;

class RegionDistrict extends Model
{
    protected $table = 'district_region';
    protected $fillable = ['district_id', 'region_id'];

    public static function updateRegionDistrictPivot($district_id, $region_id)
    {
    	$oldPivot = Self::where('district_id', $district_id)->first();
    	if($oldPivot){
    		$oldPivot->delete();
    	}
    	$pivot = Self::create([
			    		'district_id' => $district_id,
			    		'region_id' => $region_id
			    	]);

    	return $pivot;
    } 

    public static function getDistrictIdByRegionId($regionId)
    {
        return Self::where('region_id', $regionId)->get()->pluck('district_id')->toArray();
    }
}