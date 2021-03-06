<?php

namespace App\Models\Tools\ProductDelivery;

use Illuminate\Database\Eloquent\Model;
use DB;

class ProductDelivery extends Model
{
    protected $table = 'product_deliveries';
	
	/**
	 * [calculateWindow description]
	 * @return [type] [description]
	 */
	public static function calculateWindow()
	{
		$window = [];
		$currentMonth = date('n');

		/* 
		I could write some clever code to handle this, 
		but I am lazying and running out of time 
		*/
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
    	
		$depts = ProductDelivery::select(\DB::raw(
							'DEPT_NAME as name,
							(SUM(LY_MO_'.$window[0].')+SUM(LY_MO_'.$window[1].')+SUM(LY_MO_'.$window[2].')) as last_year_total,
							(SUM(TY_MO_'.$window[0].')+SUM(TY_MO_'.$window[1].')+SUM(TY_MO_'.$window[2].')) as current_year_total,
						  	sum(LY_MO_'.$window[0].') as ly_month1, 
						  	sum(TY_MO_'.$window[0].') as cy_month1,
						  	sum(LY_MO_'.$window[1].') as ly_month2, 
						  	sum(TY_MO_'.$window[1].') as cy_month2,
						  	sum(LY_MO_'.$window[2].') as ly_month3,  
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

		$subdepts = ProductDelivery::select(\DB::raw(
								'SUBDEPT_NAME as name,
								(SUM(LY_MO_'.$window[0].')+SUM(LY_MO_'.$window[1].')+SUM(LY_MO_'.$window[2].')) as last_year_total,
								(SUM(TY_MO_'.$window[0].')+SUM(TY_MO_'.$window[1].')+SUM(TY_MO_'.$window[2].')) as current_year_total,
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

		// sum(LY_TOTAL) as last_year_total, 
		// sum(TY_TOTAL) as current_year_total,
		// 
    	$classes = ProductDelivery::select(\DB::raw(
								'CLASS_NAME as name,
								(SUM(LY_MO_'.$window[0].')+SUM(LY_MO_'.$window[1].')+SUM(LY_MO_'.$window[2].')) as last_year_total,
								(SUM(TY_MO_'.$window[0].')+SUM(TY_MO_'.$window[1].')+SUM(TY_MO_'.$window[2].')) as current_year_total,
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
    	return $classes;
    }


    /**
     * [getBrands description]
     * @param  [type] $storenumber [description]
     * @param  [type] $division    [description]
     * @param  [type] $class       [description]
     * @return [type]              [description]
     */
    public static function getBrands($storenumber, $division, $department, $subdepartment, $class)
    {
    	$window = Self::calculateWindow();

    	$brands = ProductDelivery::select(\DB::raw(
								'BRAND as name,
								(SUM(LY_MO_'.$window[0].')+SUM(LY_MO_'.$window[1].')+SUM(LY_MO_'.$window[2].')) as last_year_total,
								(SUM(TY_MO_'.$window[0].')+SUM(TY_MO_'.$window[1].')+SUM(TY_MO_'.$window[2].')) as current_year_total,
							  	sum(LY_MO_'.$window[0].') as ly_month1, 
							  	sum(TY_MO_'.$window[0].') as cy_month1,
							  	sum(LY_MO_'.$window[1].') as ly_month2, 
							  	sum(TY_MO_'.$window[1].') as cy_month2,
							  	sum(LY_MO_'.$window[2].') as ly_month3,  
							  	sum(TY_MO_'.$window[2].') as cy_month3'
							))
    					->where('STORE_NUMBER', '=', $storenumber)
    					->where('DIVISION_NAME','LIKE','%'.$division.'%')
    					->where('DEPT_NAME','=', $department)
    					->where('SUBDEPT_NAME','=', $subdepartment)
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
    public static function getStyles($storenumber, $division, $subdepartment, $class, $brand)
    {
    	$window = Self::calculateWindow();

    	$styles = ProductDelivery::select(\DB::raw(
								'id,
								STYLE_NUMBER,
								STYLE_NAME,
								CODI_NUMBER,
								(SUM(LY_MO_'.$window[0].')+SUM(LY_MO_'.$window[1].')+SUM(LY_MO_'.$window[2].')) as last_year_total,
								(SUM(TY_MO_'.$window[0].')+SUM(TY_MO_'.$window[1].')+SUM(TY_MO_'.$window[2].')) as current_year_total,
							  	sum(LY_MO_'.$window[0].') as ly_month1, 
							  	sum(TY_MO_'.$window[0].') as cy_month1,
							  	sum(LY_MO_'.$window[1].') as ly_month2, 
							  	sum(TY_MO_'.$window[1].') as cy_month2,
							  	sum(LY_MO_'.$window[2].') as ly_month3,  
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
    	$classification = ProductDelivery::find($id)->get();
    	
    }


}
