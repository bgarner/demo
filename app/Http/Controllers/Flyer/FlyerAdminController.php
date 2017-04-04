<?php

namespace App\Http\Controllers\Flyer;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\UserSelectedBanner;
// use App\Models\Flyer\Flyers;
use App\Models\Flyer\FlyerData;
use App\Models\Banner;

class FlyerAdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $banner = UserSelectedBanner::getBanner();
        $banners = Banner::all();
        $flyerItems = FlyerData::getFlyerData($banner->id);
        return view('admin.flyer.index')->with('flyerItems', $flyerItems)
                                                ->with('banner', $banner)
                                                ->with('banners', $banners);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $banner = UserSelectedBanner::getBanner();
        $banners = Banner::all();
        return view('admin.flyer.upload')->with('banner', $banner)
                                                ->with('banners', $banners);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        return FlyerData::addFlyerData($request);
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
        

        $banner = UserSelectedBanner::getBanner();
        $banners = Banner::all();
        $flyer_data = FlyerData::getFlyerDataById($id);

        return view('admin.flyer.flyer-edit-modal')->with('flyer_data', $flyer_data)
                                        ->with('banner', $banner)
                                        ->with('banners', $banners);   
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
        FlyerData::updateFlyerData($id, $request);
        return redirect('/admin/flyer');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return FlyerData::deleteFlyerData($id);
    }
}
