<?php

namespace App\Http\Controllers\Alert;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Document\FileFolder;
use App\Models\Banner;
use App\Models\Alert\Alert;
use App\Models\Auth\User\UserSelectedBanner;

class AlertAdminController extends Controller
{
    /**
     * Instantiate a new AlertAdminController instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        
        $alerts = Alert::getAllAlerts();
        return view('admin.alerts.index')->with('alerts', $alerts);
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $banner = UserSelectedBanner::getBanner();
        $alert_types = ["" =>'Select one'];
        $alert_types += \DB::table('alert_types')->pluck('name', 'id')->toArray();
        $fileFolderStructure = FileFolder::getFileFolderStructure($banner->id);

        return view('admin.alerts.create')->with('alert_types', $alert_types )
                                        ->with('navigation', $fileFolderStructure);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        \Log::info($request->all());
        return Alert::createAlert($request);
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
        Alert::find($id)->delete();
        return;
    }
}
