<?php

namespace App\Http\Controllers\Auth\Role;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Auth\Role\RoleResource;

class RoleResourceAdminController extends Controller
{
    
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return RoleResource::getResourcesByRoleId($id);
    }

}
