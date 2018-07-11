<?php

namespace App\Http\Controllers\StoreApi;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class StoreStructureAdminController extends Controller
{
    public function index()
    {
    	return view('admin.storestructure.index');
    }
    
}
