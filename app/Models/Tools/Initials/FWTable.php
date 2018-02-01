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

    public static function getDepartments($storenumber, $division)
    {				
		$depts = FWTable::distinct()
						->where('DIVISION_NAME','LIKE','%'.$division.'%')
						->where('STORE_NUMBER', '=', $storenumber)
						->orderBy('DEPT_NAME','ASC')
						->get(['DEPT_NAME']);
    	return $depts;			
    }


    public static function getSubDepartments($storenumber, $division, $deparment)
    {				
		$subdepts = FWTable::distinct()
							->where('DIVISION_NAME','LIKE','%'.$division.'%')
							->where('DEPT_NAME','=', $deparment)
							->where('STORE_NUMBER', '=', $storenumber)
							->orderBy('SUBDEPT_NAME','ASC')
							->get(['SUBDEPT_NAME as name']);
    	return $subdepts;			
    }

    public static function getClasses($storenumber, $division, $subDept)
    {
    	$classes = FWTable::distinct()
    					->where('DIVISION_NAME','LIKE','%'.$division.'%')
    					->where('STORE_NUMBER', '=', $storenumber)
    					->where('SUBDEPT_NAME','=', $subDept)
    					->orderBy('CLASS_NAME','ASC')
    					->get(['CLASS_NAME as name']);
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
