<?php

namespace App\Models\Tools\DirtyNode;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class DirtyNodeArchive extends Model
{
    protected $table = 'dirty_nodes_archive';

    public static function getCleanedNodesForStoreList($stores)
    {
    	$now = Carbon::now();
    	$today = $now->toDateTimeString();
        $lastWeek = $now->subDays(7)->toDateTimeString();
    	$cleanedLastWeek =  DirtyNodeArchive::whereIn('store', $stores)
					    		 ->where('updated_at', '>', $lastWeek)
					    		 ->where('updated_at', '<' , $today)
					    		 ->select( \DB::raw('store, count(*) as total'))
					    		 ->groupBy('store')
					    		 ->get()
					    		 ->pluck('total', 'store')->toArray();

		return  ($cleanedLastWeek);
    }

    
}
