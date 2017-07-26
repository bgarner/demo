<?php

namespace App\Http\Controllers\Auth\Resource;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Auth\Resource\Resource;

class ResourceTypeAdminController extends Controller
{
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        
        return Resource::getNewResourcesByResourceTypeId($id);
    }

}
