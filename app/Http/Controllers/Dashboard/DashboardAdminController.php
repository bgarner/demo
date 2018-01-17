<?php

namespace App\Http\Controllers\Dashboard;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\StoreApi\Banner;
use App\Models\Auth\User\UserBanner;
use App\Models\Auth\User\UserSelectedBanner;
use App\Models\Dashboard\Quicklinks;
use App\Models\Feature\Feature;


class DashboardAdminController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        $banner = UserSelectedBanner::getBanner();

        $quicklinks = Quicklinks::where('banner_id', $banner->id)->orderBy('order')->get();

        $features = Feature::getActiveFeaturesByBanner($banner->id);
        
        //$oldBackgrounds = Banner::getOldBannerBackgrounds($banner_id);

        return view('admin.dashboard.index')
                ->with('banner', $banner)
                // ->with('oldBackgrounds', $oldBackgrounds)
                ->with('features', $features)
                ->with('quicklinks', $quicklinks);
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
    public function update($id, Request $request)
    {
        return Banner::updateBannerInfo($id, $request);
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
