<?php

namespace App\Http\Controllers\Communication;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\StoreApi\Banner;
use App\Models\Auth\User\UserBanner;
use App\Models\Auth\User\UserSelectedBanner;
use App\Models\Communication\Communication;
use App\Models\Communication\CommunicationType;

class CommunicationTypesAdminController extends Controller
{

  public function __construct()
    {
        //
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        $banner = UserSelectedBanner::getBanner();
        
        $communicationtypes = CommunicationType::getCommunicationTypesForAdmin();

        return view('admin.communicationtypes.index')
            ->with('communicationtypes', $communicationtypes)
            ->with('banner', $banner);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $banners = UserBanner::getAllBanners()->pluck('name', 'id')->toArray();
        return view('admin.communicationtypes.create')->with('banners', $banners);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        return CommunicationType::storeCommunicationType($request);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return $id;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        
        $banners = UserBanner::getAllBanners()->pluck('name', 'id')->toArray();
        $communicationType = CommunicationType::getCommunicationTypeById($id);
        return view('admin.communicationtypes.edit')
            ->with('communicationType', $communicationType)
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
        return CommunicationType::updateCommunicationType($id, $request);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return CommunicationType::deleteCommunicationType($id);
    }

    public function getCommunicationTypesByTarget(Request $request)
    {
        $communication = [];
        if(isset($request->communication_id)){
            $communication = Communication::find($request->communication_id);
        }
        $communicationTypes = CommunicationType::getCommunicationTypesByTarget($request);
        return view('admin.communication.communication-type-selector')->with('communicationTypes', $communicationTypes)
                                                                    ->with('communication', $communication);
    }
}
