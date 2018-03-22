<?php

namespace App\Http\Controllers\Tools;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Request as RequestFacade;
use App\Models\Tools\AgedInventory\AgedInventory;
use Log;

class AgedInventoryUpdateStatusController extends Controller
{
    public function update(Request $request)
    {
        \Log::info($request);
        $productToUpdate = AgedInventory::find($request->id);
        \Log::info($productToUpdate);
        
        if($request->action == "set"){
            if($request->location == "Front"){
                $productToUpdate->location_front = 1;
                $productToUpdate->save();
            } else {
                $productToUpdate->location_back = 1;
                $productToUpdate->save();
            }
        } else { //unset
            if($request->location == "Front"){
                $productToUpdate->location_front = 0;
                $productToUpdate->save();
            } else {
                $productToUpdate->location_back = 0;
                $productToUpdate->save();
            }
        }
        
        return;
    }
}
