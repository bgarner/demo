<?php

namespace App\Models\Tools\FootwearInitials;

use Illuminate\Database\Eloquent\Model;

class FootwearInitials extends Model
{
    protected $table = 'footwear_initials';

    public static function getFootwearInitialsByStore($storeNumber)
    {
    	$storeNumber = ltrim($storeNumber, 'A');
		$storeNumber = ltrim($storeNumber, '0');
    	return FootwearInitials::where('store_number', $storeNumber)->get();
    }

    public static function getTotalForGenderByStore($storeNumber)
    {
    	$storeNumber = ltrim($storeNumber, 'A');
		$storeNumber = ltrim($storeNumber, '0');

		$fwTotals = FootwearInitials::where('store_number', $storeNumber)
									->select(\DB::raw('sum(ly_season_total) as last_year_total, 
												  	sum(cy_season_total) as current_year_total,
												  	sum(ly_month1) as ly_month1, sum(cy_month1) as cy_month1,
												  	sum(ly_month2) as ly_month2, sum(cy_month2) as cy_month2,
												  	sum(ly_month3)  as ly_month3,  sum(cy_month3)  as cy_month3,
													subdepartment as gender, 
													store_number '))
									->groupBy('subdepartment')
									->get()
									->each(function($row){
										$row->category_totals =  json_encode(Self::getTotalForCategoryByGenderAndStoreNumber($row->store_number, $row->gender));
									});	
		return($fwTotals);
    }

    public static function getTotalForCategoryByGenderAndStoreNumber($storeNumber, $gender)
    {
		$fwTotals = FootwearInitials::where('store_number', $storeNumber)
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
									->each(function($row){
										$row->brand_totals = json_encode(Self::getTotalForBrandByCategoryAndGenderAndStoreNumber($row->store_number, $row->gender, $row->category));

									});
									
		return($fwTotals);	
    }

    public static function getTotalForBrandByCategoryAndGenderAndStoreNumber($storeNumber, $gender, $category)
    {	
    
		$fwTotals = FootwearInitials::where('store_number', $storeNumber)
									->where('subdepartment', $gender)
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
									->each(function($row){
										$row->style_totals = json_encode(Self::getTotalForStyleByBrandandCategoryAndGenderAndStoreNumber($row->store_number, $row->gender, $row->category, $row->brand));										
									});
		return($fwTotals);	
    }

    public static function getTotalForStyleByBrandandCategoryAndGenderAndStoreNumber($storeNumber, $gender, $category, $brand)
    {
    	
    	$fwTotals = FootwearInitials::where('store_number', $storeNumber)
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
