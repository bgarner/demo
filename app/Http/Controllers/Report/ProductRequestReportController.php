<?php

namespace App\Http\Controllers\Report;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Form\FormInstanceResolutionMap;
use Carbon\Carbon;

class ProductRequestReportController extends Controller
{
    public function index()
    {
     	
     	$lastWeek = Carbon::now()->subDays(7)->startOfDay()->toDateTimeString();
        $filters = [];
     	$toDate = FormInstanceResolutionMap::getResolutionCodeCountByFilter($filters);
     	$sinceLastWeek = FormInstanceResolutionMap::getResolutionCodeCountByFilter($filters, $lastWeek);
     	
        return view('manager.report.productrequest.index')
            ->with('toDate', $toDate)
            ->with('sinceLastWeek', $sinceLastWeek)
            ->with('lastWeek', $lastWeek);

    }


    public function edit(Request $request)
    {
        $filters = $request->filters;
        $lastWeek = Carbon::now()->subDays(7)->startOfDay()->toDateTimeString();
        $toDate = FormInstanceResolutionMap::getResolutionCodeCountByFilter($filters);
        $sinceLastWeek = FormInstanceResolutionMap::getResolutionCodeCountByFilter($filters, $lastWeek);
        
        return json_encode(["toDate" => $toDate, "sinceLastWeek" => $sinceLastWeek]);


    }

    
}
