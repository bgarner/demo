<?php

namespace App\Http\Controllers\Tools;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Request as RequestFacade;
use App\Models\Tools\AgedInventory\AgedInventory;
use DB;

class AgedInventoryController extends Controller
{
    public $storeNumber;

    public function __construct()
    {
        $this->storeNumber = ltrim(ltrim(RequestFacade::segment(1), '0'), 'A');
    }

    public function index()
    {
        $products = AgedInventory::getAllProductsByStoreNumber($this->storeNumber);
        return view('site.tools.agedinventory.index')
                    ->with("products", $products);
    }
}
