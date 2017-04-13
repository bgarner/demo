<?php

namespace App\Http\Controllers\Flyer;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Request as RequestFacade;
use App\Models\ProductLaunch\ProductLaunch;
use App\Models\Communication\Communication;
use App\Models\UrgentNotice\UrgentNotice;
use App\Models\Alert\Alert;
use App\Models\StoreInfo;
use App\Models\Banner;
use App\Skin;
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
        $this->isComboStore = $storeInfo->is_combo_store;
        $this->skin = Skin::getSkin($this->storeBanner);
        $this->urgentNoticeCount = UrgentNotice::getUrgentNoticeCount($this->storeNumber);
        $this->alertCount = Alert::getActiveAlertCountByStore($this->storeNumber);
        $this->communicationCount = Communication::getActiveCommunicationCount($this->storeNumber);
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
            ->with('skin', $this->skin)
            ->with('communicationCount', $this->communicationCount)
            ->with('alertCount', $this->alertCount)
            ->with('urgentNoticeCount', $this->urgentNoticeCount)
            ->with('banner', $this->banner)
            ->with('flyers', $flyers)
            ->with('isComboStore', $this->isComboStore);

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
            ->with('skin', $this->skin)
            ->with('communicationCount', $this->communicationCount)
            ->with('alertCount', $this->alertCount)
            ->with('urgentNoticeCount', $this->urgentNoticeCount)
            ->with('banner', $this->banner)
            ->with('flyer', $flyer)
            ->with('flyerItems', $flyerItems)
            ->with('isComboStore', $this->isComboStore);
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
