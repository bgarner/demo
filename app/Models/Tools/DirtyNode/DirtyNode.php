<?php

namespace App\Models\Tools\DirtyNode;

use Illuminate\Database\Eloquent\Model;
use App\Models\Utility\Utility;
use App\Models\Tools\DirtyNode\DirtyNodeArchive;


class DirtyNode extends Model
{
    protected $table = 'dirty_nodes';

    public static function getDataByStoreNumber($store_number)
    {
    	//strip off the leading zero
      $store_number = ltrim($store_number, 'A');
		  $store_number = ltrim($store_number, '0');
		  $data = DirtyNode::where('store', $store_number)
                        ->whereNull('updated_at')
                        ->get();
    	return $data;
    }

    public static function getCleanNodesByStoreNumber($store_number)
    {
        $store_number = ltrim($store_number, 'A');
        $store_number = ltrim($store_number, '0');
        $data = DirtyNode::where('store', $store_number)
                        ->whereNotNull('updated_at')
                        ->get();

        return $data;       
    }

    public static function cleanNode($id)
    {
        $node = DirtyNode::find($id);
        $node->touch();
        DirtyNodeArchive::insert($node->toArray());

    }
}
