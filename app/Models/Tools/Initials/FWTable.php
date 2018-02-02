<?php

namespace App\Models\Tools\Initials;

use Illuminate\Database\Eloquent\Model;
use DB;

class FWTable extends Model
{
    protected $table = 'initials_dump';
	
	/**
	 * [calculateWindow - this will calculate the rolling window so we don't have to do that every 3 months]
	 * @return array $window 
	 */
	public static function calculateWindow()
	{
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

	/**
	 * [getDepartments description]
	 * @param  [type] $storenumber [description]
	 * @param  [type] $division    [description]
	 * @return [type]              [description]
	 */
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

    /**
     * [getSubDepartments description]
     * @param  [type] $storenumber [description]
     * @param  [type] $division    [description]
     * @param  [type] $deparment   [description]
     * @return [type]              [description]
     */
    public static function getSubDepartments($storenumber, $division, $deparment)
    {				
    	$window = Self::calculateWindow();

		$subdepts = FWTable::select(\DB::raw(
								'SUBDEPT_NAME as name,
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
							->where('DEPT_NAME','=', $deparment)
							->where('STORE_NUMBER', '=', $storenumber)
							->groupBy('SUBDEPT_NAME')
							->orderBy('SUBDEPT_NAME','ASC')
							->get();
    	return $subdepts;			
    }

 	/**
 	 * [getClasses description]
 	 * @param  [type] $storenumber [description]
 	 * @param  [type] $division    [description]
 	 * @param  [type] $dept        [description]
 	 * @param  [type] $subDept     [description]
 	 * @return [type]              [description]
 	 */
    public static function getClasses($storenumber, $division, $dept, $subDept)
    {
    	$window = Self::calculateWindow();

    	$classes = FWTable::select(\DB::raw(
								'CLASS_NAME as name,
								sum(LY_TOTAL) as last_year_total, 
							  	sum(TY_TOTAL) as current_year_total,
							  	sum(LY_MO_'.$window[0].') as ly_month1, 
							  	sum(TY_MO_'.$window[0].') as cy_month1,
							  	sum(LY_MO_'.$window[1].') as ly_month2, 
							  	sum(TY_MO_'.$window[1].') as cy_month2,
							  	sum(LY_MO_'.$window[2].')  as ly_month3,  
							  	sum(TY_MO_'.$window[2].') as cy_month3'
							))
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


    /**
     * [getBrands description]
     * @param  [type] $storenumber [description]
     * @param  [type] $division    [description]
     * @param  [type] $class       [description]
     * @return [type]              [description]
     */
    public static function getBrands($storenumber, $division, $class)
    {
    	$window = Self::calculateWindow();

    	$brands = FWTable::select(\DB::raw(
								'BRAND as name,
								sum(LY_TOTAL) as last_year_total, 
							  	sum(TY_TOTAL) as current_year_total,
							  	sum(LY_MO_'.$window[0].') as ly_month1, 
							  	sum(TY_MO_'.$window[0].') as cy_month1,
							  	sum(LY_MO_'.$window[1].') as ly_month2, 
							  	sum(TY_MO_'.$window[1].') as cy_month2,
							  	sum(LY_MO_'.$window[2].')  as ly_month3,  
							  	sum(TY_MO_'.$window[2].') as cy_month3'
							))
    					->where('STORE_NUMBER', '=', $storenumber)
    					->where('DIVISION_NAME','LIKE','%'.$division.'%')
    					->where('CLASS_NAME','=', $class)
    					->orderBy('BRAND','ASC')
    					->groupBy('BRAND')
    					->get();
    	return $brands;
    }


    /**
     * [getStyles description]
     * @param  [type] $storenumber [description]
     * @param  [type] $division    [description]
     * @param  [type] $class       [description]
     * @param  [type] $brand       [description]
     * @return [type]              [description]
     */
    public static function getStyles($storenumber, $division, $class, $subdepartment, $brand)
    {
    	$window = Self::calculateWindow();

    	$styles = FWTable::select(\DB::raw(
								'id,
								STYLE_NUMBER,
								STYLE_NAME,
								CODI_NUMBER,
								sum(LY_TOTAL) as last_year_total, 
							  	sum(TY_TOTAL) as current_year_total,
							  	sum(LY_MO_'.$window[0].') as ly_month1, 
							  	sum(TY_MO_'.$window[0].') as cy_month1,
							  	sum(LY_MO_'.$window[1].') as ly_month2, 
							  	sum(TY_MO_'.$window[1].') as cy_month2,
							  	sum(LY_MO_'.$window[2].')  as ly_month3,  
							  	sum(TY_MO_'.$window[2].') as cy_month3'
							))
    					->where('STORE_NUMBER', '=', $storenumber)
    					->where('DIVISION_NAME','LIKE','%'.$division.'%')
    					->where('SUBDEPT_NAME','=', $subdepartment)
    					->where('CLASS_NAME','=', $class)
    					->where('BRAND','=', $brand)
    					->groupBy('id')
    					->orderBy('STYLE_NUMBER','ASC')
    					->get();
    	return $styles;
    }

    /**
     * [getItemClassification description]
     * @param  [type] $id [description]
     * @return [type]     [description]
     */
    public static function getItemClassification($id)
    {
    	$classification = FWTable::find($id)->get();
    	
    }


}
