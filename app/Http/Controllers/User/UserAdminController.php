<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Auth\User\User;
use App\Models\StoreApi\Banner;
use App\Models\StoreApi\StoreInfo;
use App\Models\Auth\Group\Group;
use App\Models\Auth\Role\Role;
use App\Models\Auth\Role\RoleResource;
use App\Models\Auth\User\UserRole;
use App\Models\Auth\User\UserBanner;
use App\Models\Auth\User\UserResource;
use App\Models\Auth\User\UserSelectedBanner;


class UserAdminController extends Controller
{
    /**
     * Instantiate a new UserAdminController instance.
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
    public function index()
    {
        
        $users = User::getAdminUsers();

        return view('superadmin.user.index')->with('users', $users);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $banners_list = Banner::all()->pluck('name', 'id');

        $groups = Group::getGroupNamesList();
        $district_name_list = StoreInfo::getDistrictNamesList();
        $region_name_list = StoreInfo::getRegionNamesList();

        return view('superadmin.user.create')
                                            ->with('group_names', $groups)
                                            ->with('banners_list', $banners_list)
                                            ->with('district_names', $district_name_list)
                                            ->with('region_names', $region_name_list);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        \Log::info("****** User ******");
        \Log::info($request->all());
        $user = User::createAdminUser($request);
        return ($user);
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
        $user = User::find($id);
        
        $banners_list = Banner::all()->pluck('name', 'id');

        $selected_banner_ids = UserBanner::where('user_id', $id)->get()->pluck('banner_id');
        $selected_banners = Banner::findMany($selected_banner_ids)->pluck('id')->toArray();

        $groups = Group::pluck('name', 'id');

        $roles = Role::pluck('role_name', 'id');
        $selected_role = UserRole::where('user_id', $user->id)->first()->role_id;

        $resources = RoleResource::getResourcesByRoleId($selected_role);
        $selected_resource = UserResource::getResourceIdByUserId($user->id);
        
        return view('superadmin.user.edit')->with('user', $user)
                                            ->with('banners_list', $banners_list)
                                            ->with('selected_banners', $selected_banners)
                                            ->with('groups', $groups)
                                            ->with('roles', $roles)
                                            ->with('selected_role', $selected_role)
                                            ->with('resources', $resources)
                                            ->with('selected_resource', $selected_resource);

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
        return User::updateAdminUser($id, $request);    
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        User::where('id', $id)->delete();
        return;
    }
}
