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

    public static function getNodeForScanner($store_number, $upc)
    {
        $store_number = ltrim($store_number, '0');
        $node = DirtyNode::where('store', $store_number)
                        ->where('upccode', $upc)
                        ->where('updated_at', null)
                        ->first();
        if(!$node){
            return json_encode((object) null);   
        }
        return json_encode($node);
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

    public static function cleanNodeFromScanner($request)
    {

        \Log::info("**** DN Scanner - attempted scan ****");
        \Log::info($request);

        $node = DirtyNode::where('item_id_sku', $request->item_id_sku)
                            ->where('node_key', $request->node_key)
                            ->where('store', $request->store)
                            ->where('updated_at', null)
                            ->first();
        if($node){
            $node->touch();
            $node->API_response = $request->DOM_API_result;
            $node->save();
            DirtyNodeArchive::insert($node->toArray());
        }   
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

                //format the dirty nodes date to match with portal's standard
                $formattedDate = Carbon::createFromFormat('m-d-Y H:i:s', $oldestByStore->starttime)->toDatetimeString();
                $oldest[$store] = Utility::prettifyDateWithTime($formattedDate);
            }
                            
        }
        

        return ($oldest);
    }

}