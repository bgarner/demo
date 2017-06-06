<?php

namespace App\Models\Tools\BikeCount;

use Illuminate\Database\Eloquent\Model;
use App\Models\Utility\Utility;
use App\Models\Tools\BikeCount\BikeBuildPriority;

class BikeCount extends Model
{
    protected $table = 'bike_count';

    public static function getDataByStoreNumber($store_number)
    {
    	//strip off the leading zero
	    $store_number = ltrim($store_number, 'A');
		$store_number = ltrim($store_number, '0');
		$data = BikeCount::where('store_number', $store_number)->get();

        foreach($data as $d){
            if(BikeBuildPriority::isPriority($d->style)){
                $d->highlight = 1;
            }
        }

    	return $data;
    }

    public static function getLastUpdatedDate()
    {
        $record = BikeCount::orderBy('created_at', 'desc')->first();
        if(count($record) > 0){
            $date = Utility::prettifyDateWithTime($record->updated_at);
            return $date;
        }
        return "";
    }
}
