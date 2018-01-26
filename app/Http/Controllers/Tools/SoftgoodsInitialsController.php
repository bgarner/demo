<?php

namespace App\Http\Controllers\Tools;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Request as RequestFacade;
use App\Models\Tools\Initials\SoftgoodsInitials;

class SoftgoodsInitialsController extends Controller
{
    public $storeNumber;

    public function __construct()
    {
        $this->storeNumber = RequestFacade::segment(1);

    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $fwInitials = SoftgoodsInitials::getTotalForDeptByStore($this->storeNumber);
        $fwInitialsMonths = \DB::table('footwear_initials_rolling_months')->first(['month1', 'month2', 'month3']);
        
        return view('site.tools.sginitials.index')->with('fwinitials', $fwInitials)
                                                ->with('fwInitialsMonths', $fwInitialsMonths)
                                                ->with('trackerTitle', 'Softgoods Deliveries Tracker');
    }
 
}
