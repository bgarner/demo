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

        $capsule = Self::makeCapsule($request);

        $client = new Client([
            'headers' => [ 'Content-Type' => 'application/json' ]
        ]);
        
        $response = $client->post($endpoint,
            ['body' => json_encode($capsule)]
        );

        $request->DOM_API_result = $response->getBody();
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

        return $capsule;
    }
}
