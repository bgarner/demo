<?php

namespace App\Models\Tools\BlackFriday;

use DB;
use Illuminate\Database\Eloquent\Model;

class BlackFriday extends Model
{
    protected $table = 'doorcrasher_tracker';
    protected $fillable = array();


    public static function getDataByStoreNumber($store_number)
    {
    	//strip off the leading zero
    	$store_number = ltrim($store_number, '0');
    	$data = BlackFriday::where('store_number', $store_number)->get();
    	foreach($data as $d){
    		$d->total_onhand_intransit = $d->oh_qty + $d->it_qty;
    	}
    	return $data;
    }



}
