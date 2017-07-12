<?php

namespace App\Http\Controllers\Tools;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Request as RequestFacade;
use App\Models\Tools\FootwearInitials\FootwearInitials;
use App\Models\Communication\Communication;
use App\Models\UrgentNotice\UrgentNotice;
use App\Models\Alert\Alert;
use App\Models\StoreInfo;
use App\Models\Banner;
use App\Skin;

class FootwearInitialsController extends Controller
{
    public $storeNumber;
    public $storeInfo;
    public $storeBanner;
    public $banner;
    public $isComboStore;
    public $skin;
    public $urgentNoticeCount;
    public $alertCount;
    public $communicationCount;

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
        $fwInitials = FootwearInitials::getTotalForGenderByStore($this->storeNumber);
        
        return view('site.tools.fwinitials.index')->with('fwinitials', $fwInitials)
                                                ->with('skin', $this->skin)
                                                ->with('communicationCount', $this->communicationCount)
                                                ->with('alertCount', $this->alertCount)
                                                ->with('urgentNoticeCount', $this->urgentNoticeCount)
                                                ->with('banner', $this->banner)
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
