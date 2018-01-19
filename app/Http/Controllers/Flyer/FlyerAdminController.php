<?php

namespace App\Http\Controllers\Flyer;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Flyer\Flyer;
use App\Models\Flyer\FlyerItem;
use App\Models\StoreApi\Banner;
use App\Models\Auth\User\UserSelectedBanner;

class FlyerAdminController extends Controller
{
    public function __construct()
    {

    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $banner = UserSelectedBanner::getBanner();
        $flyers = Flyer::getAdminFlyersByBannerId($banner->id);
        return view('admin.flyer.index')->with('flyers', $flyers);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $banner = UserSelectedBanner::getBanner();
        return view('admin.flyer.upload')->with('banner', $banner);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        return Flyer::createFlyer($request);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        
        $flyer = Flyer::getFlyerDetailsById($id);
        $flyerItems = FlyerItem::getFlyerItemsByFlyerId($id);
        return view('admin.flyer.view')->with('flyerItems', $flyerItems)
                                                ->with('flyer', $flyer);
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
        $flyer = Flyer::find($id); 
        return view('admin.flyer.flyer-edit-modal')->with('flyer', $flyer)
                                                 ->with('banner', $banner);
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
        Flyer::updateFlyer($id, $request);
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
        Flyer::deleteFlyer($id);
    }
}
