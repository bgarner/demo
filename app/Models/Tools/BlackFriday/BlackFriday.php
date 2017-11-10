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
		$data = BlackFriday::where('store_number', $store_number)
                ->where('flyer_page', '!=', '- DIGITAL')
				->where('flyer_page', '!=', '')
				->whereNotNull('flyer_page')
				->orderBy('flyer_page', 'ASC')
				// ->orderBy('ad_box', 'ASC')
				// ->groupBy('flyer_page')
				->get();

        $digital_flyer_data = BlackFriday::where('store_number', $store_number)
                ->where('flyer_page', '=', '- DIGITAL')
                ->where('flyer_page', '!=', '')
                ->whereNotNull('flyer_page')
                ->get();

        $data = $data->merge($digital_flyer_data);
    	
    	$page_and_box = "";
    	$box_total = 0;

    	foreach($data as $d){

    		$d->total_onhand_intransit = $d->oh_qty + $d->it_qty;
    		

    		if( $page_and_box != "" ){

    			if($page_and_box == $d->flyer_page ."/". $d->ad_box){
    				//same group
    				$d->newbox = 0;
    				$d->page_and_box = $page_and_box;
    				$box_total = $box_total + $d->total_onhand_intransit;
    				$d->box_total = $box_total;

    			} else {

    				//new group
    				$d->newbox = 1;
    				$d->box_total = $box_total;

    				$box_total = $d->total_onhand_intransit; //reset the box total
    				$page_and_box = $d->flyer_page ."/". $d->ad_box;
    				$d->page_and_box = $page_and_box;
    				//$box_total = 0;

    			}
    			

    		} else {
    			$box_total = $d->total_onhand_intransit;
    			$page_and_box = $d->flyer_page ."/". $d->ad_box;	
    			$d->newbox = 1;
    			$d->page_and_box = $page_and_box;
    		}
    		

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
    			//->orderBy('ad_box', 'asc')
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
