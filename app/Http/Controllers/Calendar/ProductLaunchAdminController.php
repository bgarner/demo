<?php

namespace App\Http\Controllers\Calendar;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Banner;
use App\Models\StoreInfo;
use App\Models\Auth\User\UserSelectedBanner;
use App\Models\ProductLaunch\ProductLaunch;

class ProductLaunchAdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin.auth');
        $this->middleware('banner');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $banner = UserSelectedBanner::getBanner();
        $banners = Banner::all();
        $productLaunches = ProductLaunch::getAllProductLaunches($banner->id);
        return view('admin.productlaunch.index')->with('productLaunches', $productLaunches)
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
        return view('admin.productlaunch.upload')->with('banner', $banner)
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
        return ProductLaunch::addProductLaunchData($request);
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

        return view('admin.productlaunch.add-meta-data')
                ->with('banner', $banner)
                ->with('banners', $banners)
                ->with('tags', $tags);
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
