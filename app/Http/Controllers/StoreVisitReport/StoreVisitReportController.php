<?php

namespace App\Http\Controllers\StoreVisitReport;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Request as RequestFacade;
use App\Http\Controllers\Controller;
use App\Models\StoreVisitReport\StoreVisitReport;
use App\Models\StoreApi\StoreInfo;

class StoreVisitReportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $storeNumber = RequestFacade::segment(1);
        $reports = StoreVisitReport::getReportsByStoreNumber($storeNumber);
        return view('site.storevisitreport.index')->with('reports', $reports);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($storeNumber, $id)
    {
        $storeVisitReport = StoreVisitReport::getReportById($id);
        if(!$storeVisitReport->is_draft){
            return view('site.storevisitreport.view')->with('report', $storeVisitReport);    
        }
        return redirect()->action('StoreVisitReport\StoreVisitReportController@index');
        
    }
}
