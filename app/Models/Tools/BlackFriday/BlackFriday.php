<?php

namespace App\Models\Tools\BlackFriday;

use DB;
use Illuminate\Database\Eloquent\Model;

class BlackFriday extends Model
{
    protected $table = 'doorcrasher_tracker';
    protected $fillable = array();

    public static function getAdPages($store_number)
    {
    	$store_number = ltrim($store_number, 'A');	
    	$store_number = ltrim($store_number, '0');
    	//$boxes = BlackFriday::where('store_number', $store_number)->distinct('ad_box');
    	$pages = BlackFriday::distinct()->select('flyer_page')->where('store_number', '=', $store_number)
    			->orderBy('flyer_page', 'asc')
    			->get();
    	return $pages;
    }

    public static function getDataByStoreNumber($store_number)
    {
    	//strip off the leading zero
    	$store_number = ltrim($store_number, 'A');
    	$store_number = ltrim($store_number, '0');
    	$data = BlackFriday::where('store_number', $store_number)->get();
    	foreach($data as $d){
    		$d->total_onhand_intransit = $d->oh_qty + $d->it_qty;
    	}
    	return $data;
    }


    public static function getAdBoxesByPage($store_number, $page)
    {
		$store_number = ltrim($store_number, 'A');
    	$store_number = ltrim($store_number, '0');

    	$boxes = BlackFriday::distinct()->select('ad_box')
    			->where('store_number', '=', $store_number)
    			->where('flyer_page', '=', $page)
    			->orderBy('ad_box', 'asc')
    			->get();
    	return $boxes;
    }

    public static function getAdBoxData($store_number, $flyerPage, $adBox)
    {
    	$store_number = ltrim($store_number, 'A');
    	$store_number = ltrim($store_number, '0');

    	$data = BlackFriday::where('store_number', '=', $store_number)
    			->where('flyer_page', '=', $flyerPage)
    			->where('ad_box', '=', $adBox)
    			->get();

    	 foreach($data as $d){
    		$d->total_onhand_intransit = $d->oh_qty + $d->it_qty;
    	}		
    	return $data;

    }


}
