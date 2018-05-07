<?php

namespace App\Http\Controllers\Form\ProductRequest;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Auth\User\User;
use App\Models\Form\FormRoleHierarchy;
use App\Models\Form\ProductRequest\BusinessUnitTypes;
use App\Models\Auth\Group\Group;
use App\Models\Auth\Group\GroupRole;
use App\Models\Auth\User\UserRole;
use App\Models\Form\ProductRequest\FormUserBusinessUnitMap;

class UserAdminController extends Controller
{
     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
		$employeeRoleIds = FormRoleHierarchy::getCurrentEmployeeRoleIds();

        $businessUnitId = array_keys(FormUserBusinessUnitMap::getBusinessUnitsByFormUserId(\Auth::user()->id));

        $users = User::getUsersByBusinessUnitAndRoles($employeeRoleIds, $businessUnitId);

        return view('formuser.users.index')->with('users', $users);
                        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
       	$roles = FormRoleHierarchy::getCurrentEmployeeRoles();
        $businessUnits = FormUserBusinessUnitMap::getBusinessUnitsByFormUserId(\Auth::user()->id);

		return view('formuser.users.create')->with('roles', $roles)
                                            ->with('businessUnits', $businessUnits);
                                            
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user = User::createAdminUser($request);
        return $user;
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

        $groups = Group::pluck('name', 'id');

        $roles = FormRoleHierarchy::getCurrentEmployeeRoles();
        $selected_role = UserRole::where('user_id', $user->id)->first()->role_id;

        $businessUnits = FormUserBusinessUnitMap::getBusinessUnitsByFormUserId(\Auth::user()->id);
        $selected_bu = FormUserBusinessUnitMap::getBUIdBuUserId($user->id);
        

        return view('formuser.users.edit')->with('user', $user)
                                            ->with('groups', $groups)
                                            ->with('roles', $roles)
                                            ->with('selected_role', $selected_role)
                                            ->with('businessUnits', $businessUnits)
                                            ->with('selected_bu', $selected_bu);
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
        FormUserBusinessUnitMap::where('user_id', $id)->delete();
        User::where('id', $id)->delete();
        return;
    }
}
