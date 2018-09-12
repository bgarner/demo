<?php

namespace App\Models\Tools\DirtyNode;

use Illuminate\Database\Eloquent\Model;
use GuzzleHttp\Client;
use App\Models\Tools\DirtyNode\DirtyNode;

// use App\Models\Utility\Utility;
// use App\Models\Tools\DirtyNode\DirtyNodeArchive;
// use Carbon\Carbon;

class DirtyNodeCapsule extends Model
{
    public static function sendCapsule($request)
    {
        $endpoint = env('DIRTY_NODE_ENDPOINT');
        \Log::info("*************************************");
        \Log::info($request);

        $capsule = Self::makeCapsule($request);
        $client = new Client();
        $response = $client->request('POST', $endpoint, $capsule);
        $request->DOM_API_result = $response;
        DirtyNode::cleanNodeFromScanner($request);

        return $response;
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
