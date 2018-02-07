<?php

namespace App\Models\Tools\DirtyNode;

use Illuminate\Database\Eloquent\Model;
use App\Models\Utility\Utility;

class DirtyNode extends Model
{
    protected $table = 'dirty_nodes_new';

    public static function getDataByStoreNumber($store_number)
    {
    	//strip off the leading zero
	    $store_number = ltrim($store_number, 'A');
		$store_number = ltrim($store_number, '0');
		$data = DirtyNode::where('store', $store_number)
                        ->whereNull('updated_at')
                        ->get();
        foreach($data as $d){
            //$d->start_date = Utility::prettifyDate($d->start_date);
        }
    	return $data;
    }

    public static function getCleanNodesByStoreNumber($store_number)
    {
        $store_number = ltrim($store_number, 'A');
        $store_number = ltrim($store_number, '0');
        $data = DirtyNode::where('store', $store_number)
                        ->whereNotNull('updated_at')
                        ->get();
        foreach($data as $d){
            //$d->start_date = Utility::prettifyDate($d->start_date);
            //$d->updated_at = Utility::prettifyDateWithTime($d->updated_at);
        }
        return $data;       
    }

    public static function cleanNode($id)
    {
        $node = DirtyNode::find($id);
        $node->touch();
    }
}
