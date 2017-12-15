<?php

namespace App\Models\Tools\Initials;

use Illuminate\Database\Eloquent\Model;

class Initials extends Model
{
    protected $table = 'footwear_initials';

    public static function getTotalForGenderByStore($storeNumber, $division)
    {
    	$storeNumber = ltrim($storeNumber, 'A');
		$storeNumber = ltrim($storeNumber, '0');

		$fwTotals = FootwearInitials::where('store_number', $storeNumber)
									->where('division', $division)
									->select(\DB::raw('sum(ly_season_total) as last_year_total, 
												  	sum(cy_season_total) as current_year_total,
												  	sum(ly_month1) as ly_month1, sum(cy_month1) as cy_month1,
												  	sum(ly_month2) as ly_month2, sum(cy_month2) as cy_month2,
												  	sum(ly_month3)  as ly_month3,  sum(cy_month3)  as cy_month3,
													subdepartment as gender, 
													store_number '))
									->groupBy('subdepartment')
									->get()
									->each(function($row) use ($division){
										$row->category_totals =  json_encode(Self::getTotalForCategoryByGenderAndStoreNumber($row->store_number, $row->gender, $division));
									});	
		return($fwTotals);
    }

    public static function getTotalForCategoryByGenderAndStoreNumber($storeNumber, $gender, $division)
    {
		$fwTotals = FootwearInitials::where('store_number', $storeNumber)
									->where('division', $division)
									->where('subdepartment', $gender)
									->select(\DB::raw('sum(ly_season_total) as last_year_total, 
													sum(cy_season_total) as current_year_total, 
													sum(ly_month1) as ly_month1, sum(cy_month1) as cy_month1,
													sum(ly_month2) as ly_month2, sum(cy_month2) as cy_month2,
													sum(ly_month3)  as ly_month3,  sum(cy_month3)  as cy_month3,
													category, 
													subdepartment as gender, 
													store_number'))
									->groupBy('category')
									->get()
									->each(function($row) use ($division){
										$row->brand_totals = json_encode(Self::getTotalForBrandByCategoryAndGenderAndStoreNumber($row->store_number, $row->gender, $row->category, $division));

									});
									
		return($fwTotals);	
    }

    public static function getTotalForBrandByCategoryAndGenderAndStoreNumber($storeNumber, $gender, $category, $division)
    {	
    
		$fwTotals = FootwearInitials::where('store_number', $storeNumber)
									->where('subdepartment', $gender)
									->where('division', $division)
									->where('category', $category)
									->select(\DB::raw('sum(ly_season_total) as last_year_total, 
													sum(cy_season_total) as current_year_total, 
													sum(ly_month1) as ly_month1, sum(cy_month1) as cy_month1,
													sum(ly_month2) as ly_month2, sum(cy_month2) as cy_month2,
													sum(ly_month3)  as ly_month3,  sum(cy_month3)  as cy_month3,
													brand,
													category, 
													subdepartment as gender, 
													store_number'))
									->groupBy('brand')
									->get()
									->each(function($row) use ($division){
										$row->style_totals = json_encode(Self::getTotalForStyleByBrandandCategoryAndGenderAndStoreNumber($row->store_number, $row->gender, $row->category, $row->brand, $division));										
									});
		return($fwTotals);	
    }

    public static function getTotalForStyleByBrandandCategoryAndGenderAndStoreNumber($storeNumber, $gender, $category, $brand, $division)
    {
    	
    	$fwTotals = FootwearInitials::where('store_number', $storeNumber)
									->where('division', $division)
									->where('subdepartment', $gender)
									->where('category', $category)
									->where('brand', $brand)
									->select('ly_season_total as last_year_total', 
											'cy_season_total as current_year_total', 
											'ly_month1' , 
											'cy_month1',
											'ly_month2', 
											'cy_month2',
											'ly_month3',  
											'cy_month3' ,
											'style_number', 'style_name')
									->get();
		return($fwTotals);
    }
}
