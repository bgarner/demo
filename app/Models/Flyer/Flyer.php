<?php

namespace App\Models\Flyer;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Flyer\FlyerItem;
use App\Models\Utility\Utility;
use App\Models\Validation\FlyerValidator;
use Carbon\Carbon;

class Flyer extends Model
{
    use SoftDeletes;

	protected $dates = ['deleted_at'];
    protected $table = 'flyers';
    protected $fillable = ['flyer_name', 'start_date', 'end_date', 'banner_id'];


    public static function validateCreateFlyer($request)
	{
		$validateThis =  [

		'flyer_name' => $request['flyer_name'],
		'start'      => $request['start_date'],
		'end'        => $request['end_date'],
		'document'   => $request->file('document')

		];

		\Log::info($validateThis);
	 	$v = new FlyerValidator();
	 	return $v->validate($validateThis);

	}

	public static function validateEditFlyer($request)
	{
		$validateThis =  [

			'flyer_name' => $request['flyer_name'],
			'start'      => $request['start_date'],
			'end'        => $request['end_date'],

		];

	 	\Log::info($validateThis);
	 	$v = new FlyerValidator();
	 	return $v->validate($validateThis);
	}

    public static function createFlyer($request)
    {

    	$validate = Self::validateCreateFlyer($request);
    	if($validate['validation_result'] == 'false') {
           \Log::info($validate);
           return json_encode($validate);
         }

    	$flyer = Self::create([
    		'flyer_name' => $request['flyer_name'],
    		'start_date' => $request['start_date'],
    		'end_date' => $request['end_date'],
    		'banner_id' => $request['banner_id']

    	]);

    	FlyerItem::addFlyerItems($request, $flyer->id);
    	return $flyer;
    }

    public static function getFlyersByBannerId($banner_id, $request=null)
    {
        $activeFlyers = Self::getActiveFlyersByBanner($banner_id);

        if ((isset($request['archives']) && !empty($request['archives'])) || !isset($request)) {

            $archivedFlyers = Self::getArchivedFlyersByBannerId($banner_id);
            foreach ($archivedFlyers as $archivedFlyer) {
                $activeFlyers->add($archivedFlyer);
            }

        }
    	return $activeFlyers;
    }

    public static function getAdminFlyersByBannerId($banner_id, $request=null)
    {
        $activeFlyers = Self::getFutureAndActiveFlyersByBanner($banner_id);

        if ((isset($request['archives']) && !empty($request['archives'])) || !isset($request)) {

            $archivedFlyers = Self::getArchivedFlyersByBannerId($banner_id);
            foreach ($archivedFlyers as $archivedFlyer) {
                $activeFlyers->add($archivedFlyer);
            }

        }
        return $activeFlyers;
    }    

    public static function getActiveFlyersByBanner($banner_id)
    {
        $now = Carbon::now();
        $flyers = Self::where('banner_id', $banner_id)
                    ->where('start_date', '<=', $now )
                    ->where('end_date', '>=', $now )
                    ->get()
                    ->each(function($flyer){
                        $flyer->pretty_start_date = Utility::prettifyDate($flyer->start_date);
                        $flyer->pretty_end_date = Utility::prettifyDate($flyer->end_date);
                    });
        return $flyers;
    }

    public static function getFutureAndActiveFlyersByBanner($banner_id)
    {
        $now = Carbon::now();
        $flyers = Self::where('banner_id', $banner_id)
                    ->where('end_date', '>=', $now )
                    ->get()
                    ->each(function($flyer){
                        $flyer->pretty_start_date = Utility::prettifyDate($flyer->start_date);
                        $flyer->pretty_end_date = Utility::prettifyDate($flyer->end_date);
                    });
        return $flyers;
    }    

    public static function getArchivedFlyersByBannerId($banner_id)
    {
        $now = Carbon::now();
        return Self::where('banner_id', $banner_id)
                    ->where('end_date', '<', $now )
                    ->get()
                    ->each(function($flyer){
                        $flyer->pretty_start_date = Utility::prettifyDate($flyer->start_date);
                        $flyer->pretty_end_date = Utility::prettifyDate($flyer->end_date);
                        $flyer->archived = true;
                    });
    }

    public static function getFlyerDetailsById($flyer_id)
    {
    	$flyer = Flyer::find($flyer_id);
        if($flyer){
            $flyer->pretty_start_date = Utility::prettifyDate($flyer->start_date);
            $flyer->pretty_end_date = Utility::prettifyDate($flyer->end_date);
            return $flyer;
        }
        return null;

    }

    public static function updateFlyer($id, $request)
    {
    	$validate = Self::validateEditFlyer($request);
    	if($validate['validation_result'] == 'false') {
           \Log::info($validate);
           return json_encode($validate);
         }

    	$flyer = Flyer::find($id);
    	$flyer['flyer_name'] = $request->flyer_name;
    	$flyer['start_date'] = $request->start_date;
    	$flyer['end_date'] = $request->end_date;
    	$flyer->save();
    	return;
    }

    public static function deleteFlyer($flyer_id)
    {
    	Flyer::find($flyer_id)->delete();
    	FlyerItem::where('flyer_id', $flyer_id)->delete();
    }
}
