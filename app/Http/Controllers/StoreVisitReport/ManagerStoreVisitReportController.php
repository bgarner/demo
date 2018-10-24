<?php

namespace App\Http\Controllers\StoreVisitReport;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\StoreVisitReport\StoreVisitReportInstance;
use App\Models\StoreApi\StoreInfo;
use App\Models\StoreApi\Banner;

class ManagerStoreVisitReportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //if  user is dm
        //list of previous report by the dm

        //if user is avp 
        //consolidated reports

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->user_id = \Auth::user()->id;
        $storeInfo = StoreInfo::getStoreListingByManagerId($this->user_id);
        $storesByBanner = $storeInfo->groupBy('banner_id');
        $banner = Banner::whereIn("id", $storesByBanner->keys())->get()->pluck("name", "id");
        $storeList = [ '' => 'Select One' ];
        foreach ($storeInfo as $store) {
            $storeList[$store->store_number] = $store->store_id . " " . $store->name . " (" . $banner[$store->banner_id] .")" ;
        }

        $newStoreVisitReport = StoreVisitReportInstance::getNewReport();
        return view('manager.storevisitreport.createOrUpdate')
                ->with('report', $newStoreVisitReport)
                ->with('stores', $storeList);

    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // read only version of the form once it is submitted
        dd('hello');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //editable version of the form until it is not submitted
        $this->user_id = \Auth::user()->id;
        $storeInfo = StoreInfo::getStoreListingByManagerId($this->user_id);
        $storesByBanner = $storeInfo->groupBy('banner_id');
        $banner = Banner::whereIn("id", $storesByBanner->keys())->get()->pluck("name", "id");
        $storeList = [ '' => 'Select One'];
        foreach ($storeInfo as $store) {
            $storeList[$store->store_number] = $store->store_id . " " . $store->name . " (" . $banner[$store->banner_id] .")" ;
        }

        $storeVisitReport = StoreVisitReportInstance::getReportById($id);

        dd($storeVisitReport);
        return view('manager.storevisitreport.createOrUpdate')
                ->with('report', $storeVisitReport)
                ->with('stores', $storeList);

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
        StoreVisitReportInstance::saveReport($id, $request);
    }


}
