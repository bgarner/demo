<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Auth\Group;
use App\Models\UserSelectedBanner;
use App\Models\Banner;
use App\Models\Auth\Component;
use App\Models\Auth\GroupComponent;

class GroupAdminController extends Controller
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
        $groups =  Group::getGroupDetails();
        $banner = UserSelectedBanner::getBanner();
        $banners = Banner::all();
        return view('admin.groups.index')->with('groups', $groups)
                        ->with('banners', $banners)
                        ->with('banner', $banner);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
        $banner = UserSelectedBanner::getBanner();
        $banners = Banner::all();
        $components = Component::getComponentList($banner->id);
        return view('admin.groups.create')->with('banner', $banner)
                                            ->with('banners', $banners)
                                            ->with('components', $components);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $group = Group::createGroup($request);
        return  $group;
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
        
        $banner = UserSelectedBanner::getBanner();
        $banners = Banner::all();
        $group = Group::find($id);
        $components = Component::getComponentList($banner->id);
        $selected_components = GroupComponent::getComponentListByGroupId($id);
        return view('admin.groups.edit')->with('banners', $banners)
                                        ->with('banner', $banner)
                                        ->with('components', $components)
                                        ->with('group', $group)
                                        ->with('selected_components', $selected_components);
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
        return Group::editGroup($request, $id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Group::deleteGroup($id);
    }
}
