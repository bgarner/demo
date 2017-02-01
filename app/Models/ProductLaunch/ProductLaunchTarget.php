<?php

namespace App\Models\ProductLaunch;

use Illuminate\Database\Eloquent\Model;

class ProductLaunchTarget extends Model
{
    protected $table = 'productlaunch_target';
    protected $fillable = [	'id','productlaunch_id', 'store_id' ,'created_at','updated_at'];
}
