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
        $sale_date = FlashSale::getSaleDate();
        $last_updated = FlashSale::getLastUpdatedDate();
        $sale_date = FlashSale::getSaleDate();
        if(!$last_updated){
            $last_updated = "";
        }
        
        return view('site.tools.flashsale.index')
            ->with('sale_date', $sale_date)
            ->with('last_updated', $last_updated)
            ->with('sale_date', $sale_date)
            ->with('data', $data)
            ->with('skin', $this->skin)
            ->with('communicationCount', $this->communicationCount)
            ->with('alertCount', $this->alertCount)
            ->with('urgentNoticeCount', $this->urgentNoticeCount)
            ->with('banner', $this->banner)
            ->with('isComboStore', $this->isComboStore);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
