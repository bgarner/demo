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
									->select(\DB::raw('sum(ly_season2_total) as last_year_total, 
												  	sum(cy_season2_total) as current_year_total,
												  	sum(ly_june) as ly_june, sum(cy_june) as cy_june,
												  	sum(ly_july) as ly_july, sum(cy_july) as cy_july,
												  	sum(ly_aug)  as ly_aug,  sum(cy_aug)  as cy_aug,
												  	sum(ly_sept) as ly_sept, sum(cy_sept) as cy_sept,
												  	sum(ly_oct)  as ly_oct,  sum(cy_oct)  as cy_oct,
												  	sum(ly_nov)  as ly_nov,  sum(cy_nov)  as cy_nov,
												  	sum(ly_dec)  as ly_dec,  sum(cy_dec)  as cy_dec,
													subdepartment as gender, 
													store_number '))
									->groupBy('subdepartment')
									->get()
									->each(function($row){
										$row->category_totals =  Self::getTotalForCategoryByGenderAndStoreNumber($row->store_number, $row->gender);
									});	
		return($fwTotals);
    }

    public static function getTotalForCategoryByGenderAndStoreNumber($storeNumber, $gender)
    {
		$fwTotals = FootwearInitials::where('store_number', $storeNumber)
									->where('subdepartment', $gender)
									->select(\DB::raw('sum(ly_season2_total) as last_year_total, 
													sum(cy_season2_total) as current_year_total, 
													sum(ly_june) as ly_june, sum(cy_june) as cy_june,
													sum(ly_july) as ly_july, sum(cy_july) as cy_july,
													sum(ly_aug)  as ly_aug,  sum(cy_aug)  as cy_aug,
													sum(ly_sept) as ly_sept, sum(cy_sept) as cy_sept,
													sum(ly_oct)  as ly_oct,  sum(cy_oct)  as cy_oct,
													sum(ly_nov)  as ly_nov,  sum(cy_nov)  as cy_nov,
													sum(ly_dec)  as ly_dec,  sum(cy_dec)  as cy_dec,category, 
													subdepartment as gender, 
													store_number'))
									->groupBy('category')
									->get()
									->each(function($row){
										$row->brand_totals = Self::getTotalForBrandByCategoryAndGenderAndStoreNumber($row->store_number, $row->gender, $row->category);

									});
									
		\Log::info($fwTotals);
		return($fwTotals);	
    }

    public static function getTotalForBrandByCategoryAndGenderAndStoreNumber($storeNumber, $gender, $category)
    {	
    
		$fwTotals = FootwearInitials::where('store_number', $storeNumber)
									->where('subdepartment', $gender)
									->where('category', $category)
									->select(\DB::raw('sum(ly_season2_total) as last_year_total, 
													sum(cy_season2_total) as current_year_total, 
													sum(ly_june) as ly_june, sum(cy_june) as cy_june,
													sum(ly_july) as ly_july, sum(cy_july) as cy_july,
													sum(ly_aug)  as ly_aug,  sum(cy_aug)  as cy_aug,
													sum(ly_sept) as ly_sept, sum(cy_sept) as cy_sept,
													sum(ly_oct)  as ly_oct,  sum(cy_oct)  as cy_oct,
													sum(ly_nov)  as ly_nov,  sum(cy_nov)  as cy_nov,
													sum(ly_dec)  as ly_dec,  sum(cy_dec)  as cy_dec,
													brand'))
									->groupBy('brand')
									->get();
		return($fwTotals);	
    }
}
