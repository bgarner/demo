<?php

namespace App\Models\Tools\FlashSale;

use Illuminate\Database\Eloquent\Model;
use App\Models\Utility\Utility;

class FlashSale extends Model
{
    protected $table = 'flash_sale';

    public static function getDataByStoreNumber($store_number)
    {
    	//strip off the leading zero
	    $store_number = ltrim($store_number, 'A');
		$store_number = ltrim($store_number, '0');
		$data = FlashSale::where('store_number', $store_number)->get();
    	return $data;
    }

    public static function getLastUpdatedDate()
    {
        $record = FlashSale::orderBy('created_at', 'desc')->first();
        if(count($record) > 0){
            $date = Utility::prettifyDateWithTime($record->updated_at);
            return $date;
        }
        return "";
    }
}
