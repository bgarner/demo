<?php

namespace App\Http\Controllers\Scanner;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Tools\DirtyNode\DirtyNode;
use App\Models\Tools\DirtyNode\DirtyNodeCapsule;

class ScannerApiController extends Controller
{
    public function show(Request $request)
    {
        return DirtyNode::getNodeForScanner($request->store_number, $request->upc);
    }

    public function update(Request $request)
    {
        \Log::info($request->all());
        //build object to send to CT API, make call to CT API
        return DirtyNodeCapsule::sendCapsule($request);
        //get response from CT API and sent to our cleanNode Mthod
        
        //DirtyNode::cleanNode();
    }
}
