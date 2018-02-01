<?php

namespace App\Models\Tools\Initials;

use Illuminate\Database\Eloquent\Model;
use DB;

class FWTable extends Model
{
    protected $table = 'initials_dump';
	
	/*
		DIVISION = DIVISION_NAME
		DEPARTMENT = DEPT_NAME
		SUBDEPARTMENT = SUBDEPT_NAME
		CLASS = CLASS_NAME

		We will be getting the divison based on the URL, using 'LIKE' to match it
	 */
	
	public static function calculateWindow()
	{
		//calucate rolling window
		$window = [];
		$currentMonth = date('n');

		/* I could write some clever code to handle this, but I am lazying and running out of time */
		if($currentMonth == 10){
			array_push($window, 10, 11, 12);
			return $window;
		} else if($currentMonth == 11){
			array_push($window, 11, 12, 1);
			return $window;
		} else if($currentMonth == 12){
			array_push($window, 12, 1, 2);
			return $window;
		}
	
		array_push($window, (int)$currentMonth, (int)$currentMonth+1, (int)$currentMonth+2 );	
		return $window;
	}

    public static function getDepartments($storenumber, $division)
    {				
    	$window = Self::calculateWindow();
    	
		$depts = FWTable::select(\DB::raw(
							'DEPT_NAME as name,
							sum(LY_TOTAL) as last_year_total, 
						  	sum(TY_TOTAL) as current_year_total,
						  	sum(LY_MO_'.$window[0].') as ly_month1, 
						  	sum(TY_MO_'.$window[0].') as cy_month1,
						  	sum(LY_MO_'.$window[1].') as ly_month2, 
						  	sum(TY_MO_'.$window[1].') as cy_month2,
						  	sum(LY_MO_'.$window[2].')  as ly_month3,  
						  	sum(TY_MO_'.$window[2].') as cy_month3'
						))
						->where('DIVISION_NAME','LIKE','%'.$division.'%')
						->where('STORE_NUMBER', '=', $storenumber)
						->groupBy('DEPT_NAME')
						->orderBy('DEPT_NAME','ASC')
						->get();
    	return $depts;			
    }




    public static function getSubDepartments($storenumber, $division, $deparment)
    {				
		$subdepts = FWTable::select(\DB::raw(
								'SUBDEPT_NAME as name,
								sum(LY_TOTAL) as last_year_total, 
							  	sum(TY_TOTAL) as current_year_total,
							  	sum(LY_MO_3) as ly_month1, sum(TY_MO_3) as cy_month1,
							  	sum(LY_MO_4) as ly_month2, sum(TY_MO_4) as cy_month2,
							  	sum(LY_MO_5)  as ly_month3,  sum(TY_MO_5)  as cy_month3'
							))
							->where('DIVISION_NAME','LIKE','%'.$division.'%')
							->where('DEPT_NAME','=', $deparment)
							->where('STORE_NUMBER', '=', $storenumber)
							->groupBy('SUBDEPT_NAME')
							->orderBy('SUBDEPT_NAME','ASC')
							->get();
    	return $subdepts;			
    }

  //   public static function getSubDepartmentTotals($storeNumber)
  //   {
  //   	$totals = FWTable::where('STORE_NUMBER', $storeNumber)
		// 							->select(\DB::raw(
		// 								'sum(ly_season_total) as last_year_total, 
		// 							  	sum(cy_season_total) as current_year_total,
		// 							  	sum(ly_month1) as ly_month1, sum(cy_month1) as cy_month1,
		// 							  	sum(ly_month2) as ly_month2, sum(cy_month2) as cy_month2,
		// 							  	sum(ly_month3)  as ly_month3,  sum(cy_month3)  as cy_month3'
		// 								))
		// 							->groupBy('subdept')
		// 							->get()
		// 							->each(function($row){
		// 								$row->category_totals =  json_encode(Self::getTotalForCategoryBySubdeptAndStoreNumber($row->store_number, $row->subdept, $row->department));
		// 							});
		// return $totals;
  //   }    

    public static function getClasses($storenumber, $division, $dept, $subDept)
    {

    	$classes = FWTable::select('CLASS_NAME as name')
    					->where('STORE_NUMBER', '=', $storenumber)
    					->where('DIVISION_NAME','LIKE','%'.$division.'%')
    					->where('DEPT_NAME','=', $dept)
    					->where('SUBDEPT_NAME','=', $subDept)
    					->orderBy('CLASS_NAME','ASC')
    					->groupBy('CLASS_NAME')
    					->get();
    					// ->get(['CLASS_NAME as name']);
    	// 				    	
    	// $classes = FWTable::distinct()
    	// 				->where('DIVISION_NAME','LIKE','%'.$division.'%')
    	// 				->where('STORE_NUMBER', '=', $storenumber)
    	// 				->where('SUBDEPT_NAME','=', $subDept)
    	// 				->orderBy('CLASS_NAME','ASC')
    	// 				->get(['CLASS_NAME as name']);
    	return $classes;
    }

    public static function getBrands($storenumber, $division, $class)
    {
    	$brands = FWTable::distinct()
    					->where('DIVISION_NAME','LIKE','%'.$division.'%')
    					->where('STORE_NUMBER', '=', $storenumber)
    					->where('CLASS_NAME','=', $class)
    					->orderBy('BRAND','ASC')
    					->get(['BRAND as name']);
    	return $brands;
    }

    public static function getStyles($storenumber, $division, $class, $brand)
    {
    	$styles = FWTable::select('STYLE_NUMBER','STYLE_NAME', 'CODI_NUMBER')
    					->where('STORE_NUMBER', '=', $storenumber)
    					->where('CLASS_NAME','=', $class)
    					->where('BRAND','=', $brand)
    					->orderBy('STYLE_NUMBER','ASC')
    					->get();
    	return $styles;
    }


    public static function getItemClassification($id)
    {
    	$classification = FWTable::find($id)->get();
    	
    }


}
