<?php

namespace App\Http\Controllers\Communication;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Banner;
use App\Models\Auth\User\UserBanner;
use App\Models\Auth\User\UserSelectedBanner;
use App\Models\Communication\Communication;
use App\Models\Communication\CommunicationType;

class CommunicationTypesAdminController extends Controller
{

  public function __construct()
    {
        $this->middleware('admin.auth');
        $this->middleware('superadmin.auth');
        $this->middleware('banner');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user_id = \Auth::user()->id;
        $banner_ids = UserBanner::where('user_id', $user_id)->get()->pluck('banner_id');
        $banners = Banner::whereIn('id', $banner_ids)->get();        
        $banner_id = UserSelectedBanner::where('user_id', \Auth::user()->id)->first()->selected_banner_id;
        $banner  = Banner::find($banner_id);

        $communicationtypes = CommunicationType::where('banner_id', $banner_id)->get();

        return view('admin.communicationtypes.index')
            ->with('communicationtypes', $communicationtypes)
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
        $user_id = \Auth::user()->id;
        $banner_ids = UserBanner::where('user_id', $user_id)->get()->pluck('banner_id');
        $banners = Banner::whereIn('id', $banner_ids)->get();        
        $banner_id = UserSelectedBanner::where('user_id', \Auth::user()->id)->first()->selected_banner_id;
        $banner  = Banner::find($banner_id);

        $communication_types_list = CommunicationType::all();
        return view('admin.communicationtypes.create')
            ->with('communication_types_list', $communication_types_list)
            ->with('banner', $banner)
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
        $communicationTypeDetails = array(
            'communication_type' => $request['communication_type'],
            'colour' => $request['colour'],
            'banner_id' => $request['banner_id']
        );

        $communicationType = CommunicationType::create($communicationTypeDetails);
        $communicationType->save();
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
        $banner_ids = UserBanner::where('user_id', $user_id)->get()->pluck('banner_id');
        $banners = Banner::whereIn('id', $banner_ids)->get();        
        $banner_id = UserSelectedBanner::where('user_id', \Auth::user()->id)->first()->selected_banner_id;
        $banner  = Banner::find($banner_id);

        $communicationType = CommunicationType::find($id);

        return view('admin.communicationtypes.edit')
            ->with('communicationType', $communicationType)
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

        $communicationType = CommunicationType::find($id);

        $communicationType->communication_type = $request['communication_type'];
    
        $communicationType->save();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $communicationtype = CommunicationType::find($id);
        $communicationtype->delete();
    }
}
