<?php

namespace App\Http\Controllers\Tools;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Request as RequestFacade;
use DB;

use App\Models\Tools\FlashSale\FlashSale;

class FlashSaleController extends Controller
{
    public $storeNumber;

    public function __construct()
    {
        $this->storeNumber = RequestFacade::segment(1);

    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        $data = FlashSale::getDataByStoreNumber($this->storeNumber);
        $last_updated = FlashSale::getLastUpdatedDate();
        $sale_date = FlashSale::getSaleDate($this->storeNumber);
        if(!$last_updated){
            $last_updated = "";
        }
        
        return view('site.tools.flashsale.index')
            ->with('sale_date', $sale_date)
            ->with('last_updated', $last_updated)
            ->with('data', $data);
    }
}
