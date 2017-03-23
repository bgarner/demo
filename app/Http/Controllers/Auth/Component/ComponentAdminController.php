<?php

namespace App\Http\Controllers\Auth\Component;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Auth\User\UserSelectedBanner;
use App\Models\Banner;
use App\Models\Auth\Role\Role;
use App\Models\Auth\Component\Component;
use App\Models\Auth\Role\RoleComponent;

class ComponentAdminController extends Controller
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
        $banners = Banner::all();
        $components =  Component::getComponentDetails();
        return view('admin.components.index')->with('components', $components)
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
        $roles = Role::getRoleList($banner->id);
        return view('admin.components.create')->with('banner', $banner)
                                            ->with('banners', $banners)
                                            ->with('roles', $roles);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $component = Component::createComponent($request);
        return  $component;
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
        $component = Component::find($id);
        $roles = Role::getRoleList($banner->id);
        $selected_roles = RoleComponent::getRoleListByComponentId($id);
        return view('admin.components.edit')->with('banners', $banners)
                                        ->with('banner', $banner)
                                        ->with('component', $component)
                                        ->with('roles', $roles)
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
        return Component::editComponent($request, $id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Component::deleteComponent($id);
    }
}
