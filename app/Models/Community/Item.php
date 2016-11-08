<?php

namespace App\Models\Community;

use DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Item extends Model
{
	use SoftDeletes;
    protected $table = 'community_donated_items';
    protected $dates = ['deleted_at'];
    protected $fillable = ['donation_type', 'title', 'description', 'value', 'style_number', 'upc'];


    public static function store($request)
    {
    	switch($request->donationtype){
    		case "giftcard":
    			$type = 1;
    			$value = $request->gc_value;
    			$description = "giftcard";
    			$style = $request->gc_number;
    			$upc = "0";
    			
    			break;
    		case "product":
    			$type =2;
    			$value = $request->product_value;
    			$description = $request->product_name;
    			$style = $request->style_number;
    			$upc = $request->upc;
    			
    			break;
    		default:
    			$type=1;
    			$value = 0;
    			$description = "";
    			$style = "";
    			$upc = 0;    			
    			break;
    	}

    	$item = Item::create([

    		'donation_type'  => $type,
    		'description' => $description,
    		'value' => $value,
    		'style_number' => $style,
    		'upc' => $upc

 		]);

 		$item->save();
 		$insertedId = $item->id;
    	return $insertedId;
    }
    
}
