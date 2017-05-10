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
use App\Models\Auth\Role\RoleResource;
use App\Models\Auth\Resource\ResourceTypes;

class RoleAdminController extends Controller
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
        $roles =  Role::getRoleDetails();        
        return view('admin.roles.index')->with('roles', $roles);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $groups = Group::getGroupList();
        $components = Component::getComponentList();
        $resourceTypes = ResourceTypes::getResourceTypeList();
        return view('admin.roles.create')->with('groups', $groups)
                                        ->with('components', $components)
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
        $role = Role::find($id);
        $groups = Group::getGroupList();
        $components = Component::getComponentList();
        $resourceTypes = ResourceTypes::getResourceTypeList();
        $selected_group = GroupRole::getGroupListByRoleId($id);
        $selected_components = RoleComponent::getComponentListByRoleId($id);
        $selected_resource_type = RoleResource::getResourceTypeIdByRoleId($id);
        

        return view('admin.roles.edit')->with('role', $role)
                                        ->with('groups', $groups)
                                        ->with('components', $components)
                                        ->with('resourceTypes', $resourceTypes)
                                        ->with('selected_group', $selected_group)
                                        ->with('selected_components', $selected_components)
                                        ->with('selected_resource_type', $selected_resource_type);
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
