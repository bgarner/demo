<?php

namespace App\Http\Controllers\StoreApi;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\StoreApi\Banner;

class StoreApiController extends Controller
{
    public function getAllBanners()
    {	
    	return Banner::getAllBanners();
    }
    public function getStoresByBannerid($id)
    {
    	return Banner::getStoreDetailsByBannerid($id);
    }
}
