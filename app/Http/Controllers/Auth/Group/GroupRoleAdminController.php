<?php

namespace App\Http\Controllers\Auth\Group;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Auth\Group\GroupRole;

class GroupRoleAdminController extends Controller
{

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return GroupRole::getRoleNameListByGroupId($id);
    }


}
