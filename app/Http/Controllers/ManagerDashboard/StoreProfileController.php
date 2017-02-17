<?php

namespace App\Http\Controllers\ManagerDashboard;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\StoreInfo;
use App\Models\Communication\Communication;
use App\Models\UrgentNotice\UrgentNotice;
use App\Models\Alert\Alert;
use App\Models\Analytics\Analytics;
use App\Models\ProductLaunch\ProductLaunch;

class StoreProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

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

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $urgentNotices = [];
        $alerts = [];

        $urgentNoticeCount = UrgentNotice::getUrgentNoticeCount($id);
        if($urgentNoticeCount > 0){
            $urgentNotices = UrgentNotice::getActiveUrgentNoticesByStore($id);
        }
        $alertCount = Alert::getActiveAlertCountByStore($id);
        if($alertCount > 0){
            $alerts = Alert::getActiveAlertsByStore($id);
        }
        $productLaunches = ProductLaunch::getActiveProductLaunchByStore($id);
        $communications = Communication::getActiveCommunicationsByStoreNumber($id);
        $storeInfo = StoreInfo::getStoreInfoByStoreId($id);
        $activities = Analytics::getLastXActivitiesByStore($id);

        return view('manager.storeprofile')
            ->with("storeInfo", $storeInfo)
            ->with("urgentNoticeCount", $urgentNoticeCount)
            ->with("urgentNotices", $urgentNotices)
            ->with("alertCount", $alertCount)
            ->with("alerts", $alerts)
            ->with("productLaunches", $productLaunches)
            ->with("communications", $communications)
            ->with("activities", $activities);
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
