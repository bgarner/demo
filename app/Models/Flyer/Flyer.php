<?php

namespace App\Models\Flyer;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Flyer\FlyerItem;
use App\Models\Utility\Utility;

class Flyer extends Model
{
    use SoftDeletes;
	
	protected $dates = ['deleted_at'];
    protected $table = 'flyers';
    protected $fillable = ['flyer_name', 'start_date', 'end_date', 'banner_id'];


    public static function createFlyer($request)
    {
    	$flyer = Self::create([
    		'flyer_name' => $request['flyer_name'],
    		'start_date' => $request['start_date'],
    		'end_date' => $request['end_date'],
    		'banner_id' => $request['banner_id']

    	]);

    	FlyerItem::addFlyerItems($request, $flyer->id); 
    	return $flyer;
    }


    public static function getFlyersByBannerId($banner_id)
    {
    	$flyers = Self::where('banner_id', $banner_id)->get();
    	return $flyers;
    }

    public static function getFlyerDetailsById($flyer_id)
    {
    	$flyer = Flyer::find($flyer_id);
    	$flyer->pretty_start_date = Utility::prettifyDate($flyer->start_date);
    	$flyer->pretty_end_date = Utility::prettifyDate($flyer->end_date);

    	return $flyer;
    }

    public static function deleteFlyer($flyer_id)
    {
    	Flyer::find($flyer_id)->delete();
    	FlyerItem::where('flyer_id', $flyer_id)->delete();
    }
}
