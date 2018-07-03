<?php

namespace App\Models\Tools\DirtyNode;

use Illuminate\Database\Eloquent\Model;
use App\Models\Utility\Utility;
use App\Models\Tools\DirtyNode\DirtyNodeArchive;
use Carbon\Carbon;


class DirtyNode extends Model
{
    protected $table = 'dirty_nodes';
    protected $fillable = ['API_response'];

    public static function getDataByStoreNumber($store_number)
    {
        //strip off the leading zero
        $store_number = ltrim($store_number, 'A');
        $store_number = ltrim($store_number, '0');
        $data = DirtyNode::where('store', $store_number)
                    ->whereNull('updated_at')
                    ->get();

        foreach($data as $d){
            $timestring = Carbon::createFromFormat('m-d-Y', $d->startdate)->toDateTimeString();
            $d->startDateTime = strtotime($timestring);
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

        return $data;       
    }

    public static function cleanNode($request)
    {
        $node = DirtyNode::find($request->node_id);
        $node->touch();
        $node->API_response = $request->DOM_API_result;
        $node->save();
        DirtyNodeArchive::insert($node->toArray());

    }

    public static function getTotalDirtyNodesOutstanding($stores)
    {
        
        $outstandingDN =  DirtyNode::whereIn('store', $stores)
                                 ->where('updated_at', '=', NULL)
                                 ->select( \DB::raw('store, count(*) as total'))
                                 ->groupBy('store')
                                 ->get()
                                 ->pluck('total', 'store')
                                 ->toArray();

        return ($outstandingDN);
    }

    public static function getOldestDirtyNode($stores)
    {   
        $oldest = [];
        foreach ($stores as $store ) {
            $oldestByStore = DirtyNode::where('store', $store)
                            ->orderBy('starttime','desc')
                            ->first();
            $oldest[$store] = NULL;
            if($oldestByStore){
                $oldest[$store] = $oldestByStore->starttime;
            }
                            
        }
        

        return ($oldest);
    }

}