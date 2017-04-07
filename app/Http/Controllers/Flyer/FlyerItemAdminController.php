<?php

namespace App\Http\Controllers\Flyer;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\UserSelectedBanner;
use App\Models\Banner;
use App\Models\Flyer\FlyerItem;

class FlyerItemAdminController extends Controller
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
        //
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
        return view('admin.flyer.flyer-item-add-modal')->with('banner', $banner)
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
        FlyerItem::createFlyerItem($request);
        $flyer_id = $request->flyer_id;
        return redirect('/admin/flyer/'. $flyer_id);
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
        $flyer_data = FlyerItem::getFlyerItemById($id);

        return view('admin.flyer.flyer-item-edit-modal')->with('flyer_data', $flyer_data)
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
        FlyerItem::updateFlyerItem($id, $request);
        $flyer_id = $request->flyer_id;
        return redirect('/admin/flyer/'. $flyer_id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return FlyerItem::deleteFlyerItem($id);
    }
}
