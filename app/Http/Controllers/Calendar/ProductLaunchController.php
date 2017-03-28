<?php

namespace App\Http\Controllers\Calendar;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Request as RequestFacade; 
use App\Models\ProductLaunch\ProductLaunch;
use App\Models\StoreInfo;
use App\Skin;

use App\Models\Communication\Communication;

class ProductLaunchController extends Controller
{
    
    /**
     * Instantiate a new ProductLaunchController instance.
     */
    public function __construct()
    {

        $this->storeNumber = RequestFacade::segment(1);
        $storeInfo = StoreInfo::getStoreInfoByStoreId($this->storeNumber);
        $this->storeBanner = $storeInfo->banner_id;
        $this->skin = Skin::getSkin($this->storeBanner);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $productLaunches = ProductLaunch::getActiveProductLaunchByStore($this->storeNumber);
        $lastUpdated ="";
        if ( count($productLaunches) > 0){
            $lastUpdated = ProductLaunch::getLastUpdatedTimestamp();
        }
        return view('site.calendar.productlaunch.index')
            ->with('productLaunches', $productLaunches)
            ->with('lastUpdated',  $lastUpdated)
            ->with('skin', $this->skin); 
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

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
