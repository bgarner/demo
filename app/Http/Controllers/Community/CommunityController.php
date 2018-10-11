<?php

namespace App\Http\Controllers\Community;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Request as RequestFacade; 
use DB;

use App\Skin;
use App\Models\StoreApi\StoreInfo;
use App\Models\Community\Donation;
use App\Models\Community\DonationItem;
use App\Models\Community\Item;
use App\Models\Community\DonationSport;

class CommunityController extends Controller
{
    protected $storeNumber;
    protected $storeInfo;
    protected $storeBanner;
    protected $skin;

    public function __construct()
    {
        $this->storeNumber = RequestFacade::segment(1);
        $storeInfo = StoreInfo::getStoreInfoByStoreId($this->storeNumber);
        $this->storeBanner = $storeInfo->banner_id;
        
        $this->skin = Skin::getSkin($this->storeBanner);
        
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $donations = Donation::getDonations($this->storeNumber);
        $totalDonation = Donation::getTotalDonationforStore($this->storeNumber);
        $sports = DonationSport::all();
        
        return view('site.community.audit')
            ->with('donations', $donations)
            ->with('totalDonation', $totalDonation)
            ->with('sport_dropdown', $sports)
            ->with('skin', $this->skin);          
    }
}
