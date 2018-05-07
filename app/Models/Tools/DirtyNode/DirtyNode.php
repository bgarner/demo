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
        $data = DirtyNode::where('store_number', $store_number)
                        ->whereNotNull('updated_at')
                        ->get();
        foreach($data as $d){
            $d->start_date = Utility::prettifyDate($d->start_date);
           // $d->updated_at = Utility::prettifyDateWithTime($d->updated_at);
        }
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
}
