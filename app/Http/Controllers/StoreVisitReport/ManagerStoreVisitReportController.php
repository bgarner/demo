<?php

namespace App\Http\Controllers\StoreVisitReport;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\StoreVisitReport\StoreVisitReport;
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
        
        $reports = StoreVisitReport::getReportsByManager();

        return view('manager.storevisitreport.index')->with('reports', $reports);

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

        return view('manager.storevisitreport.create')
                ->with('stores', $storeList);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $report = StoreVisitReport::saveReport($request);
        return redirect()->action('StoreVisitReport\ManagerStoreVisitReportController@index');
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $storeVisitReport = StoreVisitReport::getReportById($id);

        return view('manager.storevisitreport.view')->with('report', $storeVisitReport);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        
        $storeVisitReport = StoreVisitReport::getReportById($id);
        if(!$storeVisitReport->is_draft){
            return redirect()->action('StoreVisitReport\ManagerStoreVisitReportController@index');   
        }

        $this->user_id = \Auth::user()->id;
        $storeInfo = StoreInfo::getStoreListingByManagerId($this->user_id);
        $storesByBanner = $storeInfo->groupBy('banner_id');
        $banner = Banner::whereIn("id", $storesByBanner->keys())->get()->pluck("name", "id");
        $storeList = [ '' => 'Select One'];
        foreach ($storeInfo as $store) {
            $storeList[$store->store_number] = $store->store_id . " " . $store->name . " (" . $banner[$store->banner_id] .")" ;
        }

        
        return view('manager.storevisitreport.update')
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
        StoreVisitReport::updateReport($id, $request);

        if($request->is_draft){

            return redirect()->action('StoreVisitReport\ManagerStoreVisitReportController@edit',  ['id' => $id]);
        }
        else{
            return redirect()->action('StoreVisitReport\ManagerStoreVisitReportController@index');   
        }
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        
        StoreVisitReport::deleteReport($id);
        return;

    }


}
