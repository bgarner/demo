<?php

namespace App\Http\Controllers\StoreVisitReport;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\StoreVisitReport\StoreVisitReport;
use App\Models\StoreVisitReport\StoreVisitReportField;
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
        
        $user = \Auth::user();
        if ($user->can('create', StoreVisitReport::class)) {

        
            $storeInfo = StoreInfo::getStoreListingByManagerId($user->id);
            $storesByBanner = $storeInfo->groupBy('banner_id');
            $banner = Banner::whereIn("id", $storesByBanner->keys())->get()->pluck("name", "id");
            $storeList = [ '' => 'Select One' ];
            foreach ($storeInfo as $store) {
                $storeList[$store->store_number] = $store->store_id . " " . $store->name . " (" . $banner[$store->banner_id] .")" ;
            }

            $reportFields = StoreVisitReportField::getStoreVisitReportFields();

            return view('manager.storevisitreport.create')
                ->with('stores', $storeList)
                ->with('fields', $reportFields );
        }
        else{
            \Log::info( "User " . $user->id . ' not authorized to create report');
            return redirect()->action('StoreVisitReport\ManagerStoreVisitReportController@index');
        }

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user = \Auth::user();
        if ($user->can('store', StoreVisitReport::class)) {
            $report = StoreVisitReport::saveReport($request);
        }
        else{
            \Log::info( "User " . $user->id . ' not authorized to store report');
        }
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
        $user = \Auth::user();
        
        $storeVisitReport = StoreVisitReport::getReportById($id);
        if(!$storeVisitReport->is_draft){
            return view('manager.storevisitreport.view')->with('report', $storeVisitReport);    
        }
        return redirect()->action('StoreVisitReport\ManagerStoreVisitReportController@index');
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = \Auth::user();

        if ($user->can('edit', StoreVisitReport::find($id))) { // check the policy

            $storeVisitReport = StoreVisitReport::getReportById($id);

            $storeInfo = StoreInfo::getStoreListingByManagerId($user->id);
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
        else{
            \Log::info( "User " . $user->id . ' not authorized to edit report ' . $id);
            return redirect()->action('StoreVisitReport\ManagerStoreVisitReportController@index');
        }


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
        
        $user = \Auth::user();
        if ($user->can('update', StoreVisitReport::find($id))) { 
            StoreVisitReport::updateReport($id, $request);

            if($request->is_draft){
                return redirect()->action('StoreVisitReport\ManagerStoreVisitReportController@edit',  ['id' => $id]);
            }
            else{
                return redirect()->action('StoreVisitReport\ManagerStoreVisitReportController@index');   
            }
        }
        else{
            \Log::info( "User " . $user->id . ' not authorized to update report ' . $id);
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
        
        $user = \Auth::user();
        if($user->can('delete', StoreVisitReport::find($id))){
            StoreVisitReport::deleteReport($id);
            return;    
        }
        else{
            \Log::info( "User " . $user->id . ' not authorized to delete report ' . $id);
            return;
        }
        

    }


}
