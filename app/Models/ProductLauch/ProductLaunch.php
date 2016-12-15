<?php

namespace App\Models\ProductLauch;

use Illuminate\Database\Eloquent\Model;

class ProductLaunch extends Model
{
    protected $table = 'productlaunch';
    protected $fillable = [	'id','store_style','store_number','store_name','dpt_number','dpt_name','sdpt_number','sdpt_name','cls_number','cls_name','scls_number','scls_name','brand','style_number','style_name','clr_code','clr_name','launch_date','created_at','updated_at'];

    public static function storeProductLaunchData(){
    	
    }
}
