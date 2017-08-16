<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\StoreApi\Banner;
use App\Models\Document\FolderStructure;
use App\Models\Document\Folder;
use App\Models\Document\Package;
use App\Models\Communication\Communication;
use App\User;
use App\Models\Auth\User\UserBanner;
use App\Models\Auth\User\UserSelectedBanner;
use App\Models\Analytics\Analytics;


class AdminController extends Controller
{


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {


        // $trafficDaily = Analytics::getTrafficLast24hrs();

        // $traffic = Analytics::getTrafficLast30Days();

        // $commStats = Analytics::getCommunicationStats();
        
        // $urgentNoticeStats = Analytics::getUrgentNoticeStats();

        return view('admin.index');
                    // ->with('banner', $banner)
                    // ->with('traffic', $traffic)
                    // ->with('trafficDaily', $trafficDaily)
                    // ->with('commStats', $commStats)
                    // ->with('urgentNoticeStats', $urgentNoticeStats)
                    // ->with('banners', $banners);
        

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
