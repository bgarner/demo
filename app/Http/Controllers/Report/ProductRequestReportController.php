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
     	
     	// $lastWeek = Carbon::now()->subDays(7)->startOfDay()->toDateTimeString();
     	// $toDate = FormInstanceResolutionMap::getResolutionCodeCountByCategory();
     	// $sinceLastWeek = FormInstanceResolutionMap::getResolutionCodeCountByCategory($lastWeek);
     	
      //   return view('manager.report.productrequest.index')
      //       ->with('toDate', $toDate)
      //       ->with('sinceLastWeek', $sinceLastWeek)
      //       ->with('lastWeek', $lastWeek);

        $filters = [
            'department' => 'Softgoods',
        ];
        $toDate = FormInstanceResolutionMap::getResolutionCodeCountByFilter($filters);
        dd($toDate);

    }

    
}
