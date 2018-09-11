<?php

namespace App\Models\Tools\DirtyNode;

use Illuminate\Database\Eloquent\Model;
use GuzzleHttp\Client;

// use App\Models\Utility\Utility;
// use App\Models\Tools\DirtyNode\DirtyNodeArchive;
// use Carbon\Carbon;

class DirtyNodeCapsule extends Model
{
    public static function sendCapsule($request)
    {
        
        \Log::info("*************************************");
        \Log::info($request);

        $endpoint = env('DIRTY_NODE_ENDPOINT');
        \Log::info($endpoint);

        $capsule = Self::makeCapsule($request);
        $client = new Client();
        $response = $client->request('POST', $endpoint, $capsule);

        return $response;

        // url: "http://ordermgmt.dragonfly.cs.ctc/OrderManagement/manageInventoryNodeControl",
        // type: 'POST',
        // dataType: "JSON",
        // crossDomain: true,
        // contentType: "application/json; charset=utf-8",
        // data: cleanJSON,
    }
       
    public static function makeCapsule($request)
    {        
        $capsule = [
            "ItemID" => $request->item_id_sku,
            "Node" => $request->node_key,
            "RequestedBy" => $request->store,
            "OrganizationCode" => env('BANNER')
        ];

        \Log::info($capsule);

        return $capsule;
    }
}
