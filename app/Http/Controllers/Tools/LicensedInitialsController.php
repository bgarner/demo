<?php

namespace App\Http\Controllers\Tools;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Request as RequestFacade;
use App\Models\Tools\Initials\LicensedInitials;

class LicensedInitialsController extends Controller
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
        $initials = LicensedInitials::getTotalForDeptByStore($this->storeNumber);
        $initialsMonths = \DB::table('footwear_initials_rolling_months')->first(['month1', 'month2', 'month3']);
        
        return view('site.tools.hginitials.index')->with('fwinitials', $initials)
                                                ->with('fwInitialsMonths', $initialsMonths)
                                                ->with('trackerTitle', 'Licensed Product Deliveries Tracker');
    }
}
