<?php

namespace App\Http\Controllers\Flyer;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Request as RequestFacade;
use App\Models\ProductLaunch\ProductLaunch;
use App\Models\StoreApi\StoreInfo;
use App\Models\StoreApi\Banner;
use App\Models\Flyer\Flyer;
use App\Models\Flyer\FlyerItem;


class FlyerController extends Controller
{

    public function __construct()
    {
        $this->storeNumber = RequestFacade::segment(1);
        $storeInfo = StoreInfo::getStoreInfoByStoreId($this->storeNumber);
        $this->storeBanner = $storeInfo->banner_id;
        $this->banner = Banner::find($this->storeBanner);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $flyers = Flyer::getFlyersByBannerId($this->banner->id);
        return view('site.flyer.index')
            ->with('flyers', $flyers);

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
    public function show($storenumber, $id)
    {
        $flyer = Flyer::getFlyerDetailsById($id);
        if( !$flyer ){
            return redirect( $this->storeNumber . '/flyer');
        }
        $flyerItems = FlyerItem::getFlyerItemsByFlyerId($id);
        return view('site.flyer.flyer')
            ->with('flyer', $flyer)
            ->with('flyerItems', $flyerItems);
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
