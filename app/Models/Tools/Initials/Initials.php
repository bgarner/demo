<?php

namespace App\Models\Tools\Initials;

use Illuminate\Database\Eloquent\Model;

class Initials extends Model
{
    protected $table = 'footwear_initials';

    public static function getTotalForDeptByStore($storeNumber, $division)
    {
        $storeNumber = ltrim($storeNumber, 'A');
        $storeNumber = ltrim($storeNumber, '0');

        $fwTotals = Self::where('store_number', $storeNumber)
                                    ->where('division', $division)
                                    ->select(\DB::raw('sum(ly_season_total) as last_year_total, 
                                                    sum(cy_season_total) as current_year_total,
                                                    sum(ly_month1) as ly_month1, sum(cy_month1) as cy_month1,
                                                    sum(ly_month2) as ly_month2, sum(cy_month2) as cy_month2,
                                                    sum(ly_month3)  as ly_month3,  sum(cy_month3)  as cy_month3,
                                                    subdepartment as subdept, 
                                                    store_number,department'))
                                    ->groupBy('department')
                                    ->get()
                                    ->each(function($row) use ($division){
                                        
                                        $row->subdept_totals =  json_encode(Initials::getTotalForSubdeptByStore($row->store_number, $division, $row->department));
                                    }); 
        return($fwTotals);
    }

    public static function getTotalForSubdeptByStore($storeNumber, $division, $department = null)
    {
    	$storeNumber = ltrim($storeNumber, 'A');
		$storeNumber = ltrim($storeNumber, '0');

		$query  = Initials::where('store_number', $storeNumber)
									->where('division', $division);
		if(isset($department)){
			$query->where('department', $department);
		}

		$fwTotals = $query->select(\DB::raw('sum(ly_season_total) as last_year_total, 
						  	sum(cy_season_total) as current_year_total,
						  	sum(ly_month1) as ly_month1, sum(cy_month1) as cy_month1,
						  	sum(ly_month2) as ly_month2, sum(cy_month2) as cy_month2,
						  	sum(ly_month3)  as ly_month3,  sum(cy_month3)  as cy_month3,
							subdepartment as subdept, 
							store_number,department '))
						->groupBy('subdept')
						->get()
						->each(function($row) use ($division){
							$row->category_totals =  json_encode(Self::getTotalForCategoryBySubdeptAndStoreNumber($row->store_number, $row->subdept, $division));
						});	
		return($fwTotals);
    }

    public static function getTotalForCategoryBySubdeptAndStoreNumber($storeNumber, $subdept, $division)
    {
		$fwTotals = Initials::where('store_number', $storeNumber)
									->where('division', $division)
									->where('subdepartment', $subdept)
									->select(\DB::raw('sum(ly_season_total) as last_year_total, 
													sum(cy_season_total) as current_year_total, 
													sum(ly_month1) as ly_month1, sum(cy_month1) as cy_month1,
													sum(ly_month2) as ly_month2, sum(cy_month2) as cy_month2,
													sum(ly_month3)  as ly_month3,  sum(cy_month3)  as cy_month3,
													category, 
													subdepartment as subdept, 
													store_number'))
									->groupBy('category')
									->get()
									->each(function($row) use ($division){
										$row->brand_totals = json_encode(Self::getTotalForBrandByCategoryAndSubdeptAndStoreNumber($row->store_number, $row->subdept, $row->category, $division));

									});
									
		return($fwTotals);	
    }

    public static function getTotalForBrandByCategoryAndSubdeptAndStoreNumber($storeNumber, $subdept, $category, $division)
    {	
    
		$fwTotals = Initials::where('store_number', $storeNumber)
									->where('subdepartment', $subdept)
									->where('division', $division)
									->where('category', $category)
									->select(\DB::raw('sum(ly_season_total) as last_year_total, 
													sum(cy_season_total) as current_year_total, 
													sum(ly_month1) as ly_month1, sum(cy_month1) as cy_month1,
													sum(ly_month2) as ly_month2, sum(cy_month2) as cy_month2,
													sum(ly_month3)  as ly_month3,  sum(cy_month3)  as cy_month3,
													brand,
													category, 
													subdepartment as subdept, 
													store_number'))
									->groupBy('brand')
									->get()
									->each(function($row) use ($division){
										$row->style_totals = json_encode(Self::getTotalForStyleByBrandandCategoryAndSubdeptAndStoreNumber($row->store_number, $row->subdept, $row->category, $row->brand, $division));										
									});
		return($fwTotals);	
    }

    public static function getTotalForStyleByBrandandCategoryAndSubdeptAndStoreNumber($storeNumber, $subdept, $category, $brand, $division)
    {
    	
    	$fwTotals = Initials::where('store_number', $storeNumber)
									->where('division', $division)
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
											'style_number', 'style_name')
									->get();
		return($fwTotals);
    }
}
