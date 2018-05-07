<?php

namespace App\Http\Controllers\Tools;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Http\Controllers\Controller;
use App\Models\Tools\DirtyNode\DirtyNodeArchive;
use App\Models\Utility\Utility;

class DirtyNodesAdminController extends Controller
{
    public function index()
    {
        $now = Carbon::now();
    	$today = $now->toDateTimeString();
        $yesterday = $now->subDays(1);
        $yesterday = $yesterday->toDateTimeString();
        $yesterdayPretty = Utility::prettifyDate($yesterday);

        $data = DirtyNodeArchive::where('updated_at', '<', $today)
                ->where('updated_at', '>', $yesterday)
                ->orderBy('updated_at', 'desc')
                ->get();


        return view('admin.dirtynodes.index')
            ->with('yesterday', $yesterdayPretty)
            ->with('data', $data);
    }

    public function show(Request $request)
    {
    	if(!isset($request->start)){
    		$start = Carbon::yesterday()->toDateTimeString();
    		$end = Carbon::yesterday()->endOfDay()->toDateTimeString();
    	}
    	else{
    		$start = $request->start;
    		$end = $request->end;
    	}
    	
    	$data = DirtyNodeArchive::whereBetween('updated_at', [$start, $end])->get();
    	return $data;
    }
}
