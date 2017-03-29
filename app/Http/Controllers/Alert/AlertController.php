<?php

namespace App\Http\Controllers\Alert;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Request as RequestFacade; 
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Alert\Alert;
use App\Models\Alert\AlertType;

class AlertController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(request $request)
    {
        $storeNumber = RequestFacade::segment(1);

    
        $alertTypes = AlertType::getAlertTypesByStoreNumber($request, $storeNumber);

        $title = Alert::getAlertCategoryName($request['type']);

        $alertCount = Alert::getAlertCountByStoreNumber($request, $storeNumber); 

        $alerts = Alert::getAlertsByStoreNumber($request, $storeNumber);        
 

        return view('site.alerts.index')
            ->with('alerts', $alerts)
            ->with('alertTypes', $alertTypes)
            ->with('alertCount', $alertCount)
            ->with('title', $title)
            ->with('archives', $request['archives']);
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
