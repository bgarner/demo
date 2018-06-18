<?php

namespace App\Http\Controllers\Community;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use DB;

use App\Models\Community\Donation;
use App\Models\Community\DonationItem;
use App\Models\Community\Item;
use App\Models\Community\DonationSport;
use App\Models\StoreApi\Banner;

class CommunityReportController extends Controller
{
    // protected $storeNumber;
    // protected $storeInfo;
    // protected $storeBanner;
    // protected $skin;

    public function __construct()
    {
        // $this->storeNumber = RequestFacade::segment(1);
        // $storeInfo = StoreInfo::getStoreInfoByStoreId($this->storeNumber);
        // $this->storeBanner = $storeInfo->banner_id;
        
        // $this->skin = Skin::getSkin($this->storeBanner);
        
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function ytd()
    {
        header('Content-Disposition: attachment; filename="ytd_totals.csv"');
        header("Cache-control: private");
        header("Content-type: application/force-download");
        header("Content-transfer-encoding: binary\n");

        $sc_stores = Banner::getStoreDetailsByBannerid(1);
        $atmo_stores = Banner::getStoreDetailsByBannerid(2);
        $all_stores = $sc_stores->merge($atmo_stores);
        $csv = "Banner, Store Number, Store Name, YTD Donation \r\n";
       //echo $all_stores[0];
        foreach($all_stores as $s){
            if( $s->banner_id == 1)
                $banner = "SC";
            else {
                $banner = "ATMO";
            }
            $totalDonation = Donation::getTotalDonationforStore($s->store_number);
            $totalDonation = str_replace(",","", $totalDonation);
            $csv = $csv . $banner . ', ' . $s->store_number . ', ' . $s->name . ', ' .$totalDonation  . "\r\n";
        }
        echo $csv;
              
    }

    public function details()
    {
        header('Content-Disposition: attachment; filename="ytd_details.csv"');
        header("Cache-control: private");
        header("Content-type: application/force-download");
        header("Content-transfer-encoding: binary\n");

        $details = \DB::select( 
                    \DB::raw('select community_donations.store_number, 
                            community_donations.event_or_team_name, 
                            community_donations.recipient_organization, 
                            community_donated_items.description, 
                            community_donated_items.value, 
                            community_donations.dm_approval,
                            community_donations.created_at
                        FROM `community_donations`
                        left join `community_donations_items` on `community_donations`.`id` = `community_donations_items`.`donation_id`
                        left join `community_donated_items` on `community_donations_items`.`item_id` = `community_donated_items`.`id`
                        order by `community_donations`.`store_number`')
                    );
        //dd($details);

        $csv = "store_number, event_or_team_name, recipient_organization, description, value, dm_approval, created_at  \r\n";
       //echo $all_stores[0];
        foreach($details as $d){
            $d->value = str_replace(",","", $d->value);
            $csv = $csv . $d->store_number . ', "' . $d->event_or_team_name . '", "' . $d->recipient_organization . '", "' . $d->description . '", "' . $d->value . '", ' . $d->dm_approval . ', ' . $d->created_at . "\r\n";
        }
        echo $csv;
              
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
