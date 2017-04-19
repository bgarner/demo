<?php

namespace App\Http\Controllers\Auth\Resource;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Auth\User\UserSelectedBanner;
use App\Models\Banner;
use App\Models\Auth\Resource\Resource;
use App\Models\Auth\Resource\ResourceTypes;
use App\Models\Auth\Role\Role;
use App\Models\Auth\Role\RoleResource;

class ResourceAdminController extends Controller
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
        $resources =  Resource::getResourceDetails();
        $banner = UserSelectedBanner::getBanner();
        $banners = Banner::all();
        return view('admin.resources.index')->with('resources', $resources)
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
        $resourceTypes = ResourceTypes::getResourceTypeList();
        $roles = Role::getRoleList();
        // dd($resourceTypes);
        return view('admin.resources.create')->with('banner', $banner)
                                            ->with('banners', $banners)
                                            ->with('roles', $roles)
                                            ->with('resourceTypes', $resourceTypes);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $resource = Resource::createResource($request);
        return  $resource;
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
        $resource = Resource::find($id);
        $roles = Role::getRoleList($banner->id);
        $selected_roles = RoleResource::getRoleByResourceId($id);
        return view('admin.resources.edit')->with('banners', $banners)
                                        ->with('banner', $banner)
                                        ->with('roles', $roles)
                                        ->with('resource', $resource)
                                        ->with('selected_roles', $selected_roles);
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
        return Resource::editResource($request, $id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Resource::deleteResource($id);
    }
}
