<?php

namespace App\Models\StoreApi;

use Illuminate\Database\Eloquent\Model;


class DistrictStore extends Model
{
    protected $table = 'district_store';
    protected $fillable = ['store_id', 'district_id'];

    public static function updateDistrictStorePivot($store_id, $district_id)
    {
    	$oldPivot = Self::where('store_id', $store_id)->first();
    	if($oldPivot){
    		$oldPivot->delete();
    	}
    	$pivot = Self::create([
			    		'store_id' => $store_id,
			    		'district_id' => $district_id
			    	]);

    	return $pivot;
    }
}
