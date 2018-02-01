<?php

namespace App\Http\Controllers\Tools;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Tools\Initials\FWTable as Data;
use Illuminate\Support\Facades\Request as RequestFacade;
use DB;

class InitialsController extends Controller
{

	public $storeNumber;

    public function __construct()
    {
        $this->storeNumber = ltrim(ltrim(RequestFacade::segment(1), '0'), 'A');
		$this->month = Date('n');
		$this->division = RequestFacade::segment(4); //footwear, hardgoods, softgoods
    }

    public function index()
    {
    	$depts = Data::getDepartments($this->storeNumber, $this->division);
    		return view('site.tools.fwinitials.index')
    		->with('departments', $depts);
    }

    public function getDepartments(Request $request)
    {
    	return Data::getDepartments($request->storenumber, $request->division);
    }

    public function getSubDepartments(Request $request)
    {
    	return Data::getSubDepartments($request->storenumber, $request->division, $request->department);
    }

    public function getClasses(Request $request)
    {
    	return Data::getClasses($request->storenumber, $request->division, $request->department, $request->subdepartment);
    }

    public function getBrands(Request $request)
    {
    	return Data::getBrands($request->storenumber, $request->division, $request->class);
    }

    public function getStyles(Request $request)
    {
    	return Data::getStyles($request->storenumber, $request->division, $request->class, $request->brand);
    }
}
