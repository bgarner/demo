<?php

namespace App\Http\Controllers\Tools;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Http\Controllers\Controller;
use App\Models\Tools\DirtyNode\DirtyNodeArchive;

class DirtyNodesAdminController extends Controller
{
    public function index()
    {
    	
        $data = DirtyNodeArchive::all()->sortByDesc('updated_at');
        return view('admin.dirtynodes.index')
            ->with('data', $data);
    }

    public function show(Request $request)
    {
    	if(!isset($request->start)){
    		$start = Carbon::now()->subDay()->toDateTimeString();
    		$end = Carbon::now()->toDateTimeString();
    	}
    	else{
    		$start = $request->start;
    		$end = $request->end;
    	}

    	
    	$data = DirtyNodeArchive::whereBetween('updated_at', [$start, $end])->get();

    	return $data;
    }
}
