<?php

namespace App\Models\Flyer;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Flyer extends Model
{
	use SoftDeletes;
    protected $table = 'flyer';
    protected $dates = ['deleted_at'];
    protected $fillable = ['category', 'brand_name', 'product_name', 'pmm', 'disclaimer', 'original_price', 'sale_price', 'notes'];


    public static function getFlyerData()
    {
    	$flyerItems = Self::all();

    	foreach($flyerItems as $fi){

    		$pmm_array = unserialize($fi->pmm);
    		$image_url_array = array();

    		foreach($pmm_array as $item){
    			array_push($image_url_array, "https://fgl.scene7.com/is/image/FGLSportsLtd/".$item."_99_a?bgColor=0,0,0,0&fmt=png-alpha&hei=200&resMode=sharp2&op_sharpen=1");
    		}
    		$fi->pmm_numbers = $pmm_array;
    		$fi->image_urls = $image_url_array;

    	}

    	return $flyerItems;
    }
}
