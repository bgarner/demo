<?php

namespace App\Models\Tools\DirtyNode;

use Illuminate\Database\Eloquent\Model;
use App\Models\Utility\Utility;

class DirtyNode extends Model
{
    protected $table = 'dirty_nodes';

    public static function getDataByStoreNumber($store_number)
    {
    	//strip off the leading zero
	    $store_number = ltrim($store_number, 'A');
		$store_number = ltrim($store_number, '0');
		$data = DirtyNode::where('store_number', $store_number)->get();
    	return $data;
    }
}
