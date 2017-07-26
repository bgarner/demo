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

        $communicationtypes = CommunicationType::where('banner_id', $banner->id)->get();

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
        return view('admin.communicationtypes.create');
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
        
        $communicationType = CommunicationType::find($id);
        return view('admin.communicationtypes.edit')
            ->with('communicationType', $communicationType);
            
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
