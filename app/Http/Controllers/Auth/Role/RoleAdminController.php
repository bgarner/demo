<?php

namespace App\Http\Controllers\Auth\Role;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Auth\Group\Group;
use App\Models\Auth\Role\Role;
use App\Models\Auth\User\UserSelectedBanner;
use App\Models\Banner;
use App\Models\Auth\Component\Component;
use App\Models\Auth\Group\GroupRole;
use App\Models\Auth\Role\RoleComponent;

class RoleAdminController extends Controller
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
        $roles =  Role::getRoleDetails();
        $banner = UserSelectedBanner::getBanner();
        $banners = Banner::all();
        return view('admin.roles.index')->with('roles', $roles)
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
        $groups = Group::getGroupList();
        $components = Component::getComponentList($banner->id);
        return view('admin.roles.create')->with('banner', $banner)
                                            ->with('banners', $banners)
                                            ->with('groups', $groups)
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
        $role = Role::createRole($request);
        return  $role;
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
        $role = Role::find($id);
        $groups = Group::getGroupList($banner->id);
        $components = Component::getComponentList($banner->id);
        $selected_groups = GroupRole::getGroupListByRoleId($id);
        $selected_components = RoleComponent::getComponentListByRoleId($id);
        return view('admin.roles.edit')->with('banners', $banners)
                                        ->with('banner', $banner)
                                        ->with('role', $role)
                                        ->with('groups', $groups)
                                        ->with('components', $components)
                                        ->with('selected_groups', $selected_groups)
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
        return Role::editRole($request, $id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Role::deleteRole($id);
    }
}
