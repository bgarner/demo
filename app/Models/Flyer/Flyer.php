<?php

namespace App\Models\Flyer;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Flyer\FlyerData;

class Flyer extends Model
{
    use SoftDeletes;
	
	protected $dates = ['deleted_at'];
    protected $table = 'flyers';
    protected $fillable = ['flyer_name', 'start_date', 'end_date'];


    public static function createFlyer($request)
    {
    	$flyer = Self::create([
    		'flyer_name' => $request['flyer_name'],
    		'start_date' => $request['start_date'],
    		'end_date' => $request['end_date']

    	]);

    	FlyerData::addFlyerData($request, $flyer->id); 
    	return $flyer;
    }


    public static function getFlyersByBannerId($banner_id)
    {
    	// put in banner_id and update query;
    	// $flyers = Self::where('banner_id', $banner_id)->get();
    	//return $flyersl
    	return Self::all();
    }
}
