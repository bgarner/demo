<?php

namespace App\Models\Tools\FlashSale;

use Illuminate\Database\Eloquent\Model;

class FlashSale extends Model
{
    public static function getDataByStoreNumber($store_number)
    {
    	//strip off the leading zero
	    $store_number = ltrim($store_number, 'A');
		$store_number = ltrim($store_number, '0');
		$data = FlashSale::where('store_number', $store_number)->get();
    	return $data;
    }
}
