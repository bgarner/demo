<?php

namespace App\Http\Controllers\Tools;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Tools\CustomStoreGroup;
use App\Models\StoreApi\StoreInfo;
use App\Models\Utility\Utility;
use App\Models\Auth\User\UserSelectedBanner;

class CustomStoreGroupAdminController extends Controller
{
    /**
     * Instantiate a new CommunicationAdminController instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $banner = UserSelectedBanner::getBanner();
        $storegroups = CustomStoreGroup::getGroupsByBanner($banner->id);
        return view('admin.storegroup.index')->with('storegroups', $storegroups);                                   
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        
        $storeList = Utility::getStoreListByBannerId();
        return view('admin.storegroup.create')->with('storeList', $storeList);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
    	return CustomStoreGroup::saveStoreGroup($request);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id, Request $request)
    {
        
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id, Request $request)
    {
        $storeList = Utility::getStoreListByBannerId();
        $storeGroup = CustomStoreGroup::find($id);
        $storeGroup->stores = unserialize($storeGroup->stores);
        return view('admin.storegroup.edit')->with('storeGroup', $storeGroup)
                                            ->with('storeList', $storeList);   
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
        return CustomStoreGroup::editStoreGroup($request, $id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, Request $request)
    {
        CustomStoreGroup::find($id)->delete();
    }
}