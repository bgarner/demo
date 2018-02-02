<?php

namespace App\Models\Tools\Initials;

use Illuminate\Database\Eloquent\Model;
use App\Models\Tools\Initials\FootwearInitials;

class FootwearInitials extends Model
{
    protected $table = 'footwear_initials';

    public static function getTotalForSubdeptByStore($storeNumber)
    {
    	$storeNumber = ltrim($storeNumber, 'A');
		$storeNumber = ltrim($storeNumber, '0');

		$fwTotals = FootwearInitials::where('store_number', $storeNumber)
									->select(\DB::raw('sum(ly_season_total) as last_year_total, 
									  	sum(cy_season_total) as current_year_total,
									  	sum(ly_month1) as ly_month1, sum(cy_month1) as cy_month1,
									  	sum(ly_month2) as ly_month2, sum(cy_month2) as cy_month2,
									  	sum(ly_month3)  as ly_month3,  sum(cy_month3)  as cy_month3,
										subdepartment as subdept, 
										department,
										store_number, updated_at'))
									->groupBy('subdept')
									->get()
									->each(function($row){
										$row->category_totals =  json_encode(Self::getTotalForCategoryBySubdeptAndStoreNumber($row->store_number, $row->subdept, $row->department));
									});	
		return($fwTotals);
    }

    public static function getTotalForCategoryBySubdeptAndStoreNumber($storeNumber, $subdept, $department)
    {
		$fwTotals = FootwearInitials::where('store_number', $storeNumber)
									->where('department', $department)
									->where('subdepartment', $subdept)
									->select(\DB::raw('sum(ly_season_total) as last_year_total, 
													sum(cy_season_total) as current_year_total, 
													sum(ly_month1) as ly_month1, sum(cy_month1) as cy_month1,
													sum(ly_month2) as ly_month2, sum(cy_month2) as cy_month2,
													sum(ly_month3)  as ly_month3,  sum(cy_month3)  as cy_month3,
													category, 
													subdepartment as subdept, 
													department,
													store_number'))
									->groupBy('category')
									->get()
									->each(function($row){
										$row->brand_totals = json_encode(Self::getTotalForBrandByCategoryAndSubdeptAndStoreNumber($row->store_number, $row->subdept, $row->category, $row->department));

									});
									
		return($fwTotals);	
    }

    public static function getTotalForBrandByCategoryAndSubdeptAndStoreNumber($storeNumber, $subdept, $category, $department)
    {	
    
		$fwTotals = FootwearInitials::where('store_number', $storeNumber)
									->where('department', $department)
									->where('subdepartment', $subdept)
									->where('category', $category)
									->select(\DB::raw('sum(ly_season_total) as last_year_total, 
													sum(cy_season_total) as current_year_total, 
													sum(ly_month1) as ly_month1, sum(cy_month1) as cy_month1,
													sum(ly_month2) as ly_month2, sum(cy_month2) as cy_month2,
													sum(ly_month3)  as ly_month3,  sum(cy_month3)  as cy_month3,
													brand,
													category, 
													subdepartment as subdept, 
													department,
													store_number'))
									->groupBy('brand')
									->get()
									->each(function($row){
										$row->style_totals = json_encode(Self::getTotalForStyleByBrandandCategoryAndSubdeptAndStoreNumber($row->store_number, $row->subdept, $row->category, $row->brand, $row->department));										
									});
		return($fwTotals);	
    }

    public static function getTotalForStyleByBrandandCategoryAndSubdeptAndStoreNumber($storeNumber, $subdept, $category, $brand, $department)
    {
    	
    	$fwTotals = FootwearInitials::where('store_number', $storeNumber)
									->where('department', $department)
									->where('subdepartment', $subdept)
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
											'style_number', 'style_name', 'codi_number')
									->get();
		return($fwTotals);
    }
}
