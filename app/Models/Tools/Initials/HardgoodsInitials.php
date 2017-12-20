<?php

namespace App\Models\Tools\Initials;

use Illuminate\Database\Eloquent\Model;

class HardgoodsInitials extends Model
{
    protected $table = 'hardgoods_initials';

    public static function getTotalForDeptByStore($storeNumber)
    {
        $storeNumber = ltrim($storeNumber, 'A');
        $storeNumber = ltrim($storeNumber, '0');

        $hgTotals = HardgoodsInitials::where('store_number', $storeNumber)
                                    ->select(\DB::raw('sum(ly_season_total) as last_year_total, 
                                                    sum(cy_season_total) as current_year_total,
                                                    sum(ly_month1) as ly_month1, sum(cy_month1) as cy_month1,
                                                    sum(ly_month2) as ly_month2, sum(cy_month2) as cy_month2,
                                                    sum(ly_month3)  as ly_month3,  sum(cy_month3)  as cy_month3,
                                                    subdepartment as subdept, 
                                                    store_number,department'))
                                    ->groupBy('department')
                                    ->get()
                                    ->each(function($row){
                                        
                                        $row->subdept_totals =  json_encode(HardgoodsInitials::getTotalForSubdeptByStore($row->store_number, $row->department));
                                    }); 
        return($hgTotals);
    }

    public static function getTotalForSubdeptByStore($storeNumber, $department)
    {

		$hgTotals  = HardgoodsInitials::where('store_number', $storeNumber)
									->where('department', $department)
									->select(\DB::raw('sum(ly_season_total) as last_year_total, 
									  	sum(cy_season_total) as current_year_total,
									  	sum(ly_month1) as ly_month1, sum(cy_month1) as cy_month1,
									  	sum(ly_month2) as ly_month2, sum(cy_month2) as cy_month2,
									  	sum(ly_month3)  as ly_month3,  sum(cy_month3)  as cy_month3,
										subdepartment as subdept, 
										store_number,department '))
									->groupBy('subdept')
									->get()
									->each(function($row){
										$row->category_totals =  json_encode(HardgoodsInitials::getTotalForCategoryBySubdeptAndStoreNumber($row->store_number, $row->subdept, $row->department));
									});	
		return($hgTotals);
    }

    public static function getTotalForCategoryBySubdeptAndStoreNumber($storeNumber, $subdept, $department)
    {
		$hgTotals = HardgoodsInitials::where('store_number', $storeNumber)
									->where('department', $department)
									->where('subdepartment', $subdept)
									->select(\DB::raw('sum(ly_season_total) as last_year_total, 
													sum(cy_season_total) as current_year_total, 
													sum(ly_month1) as ly_month1, sum(cy_month1) as cy_month1,
													sum(ly_month2) as ly_month2, sum(cy_month2) as cy_month2,
													sum(ly_month3)  as ly_month3,  sum(cy_month3)  as cy_month3,
													category, 
													subdepartment as subdept, department,
													store_number'))
									->groupBy('category')
									->get()
									->each(function($row){
										$row->brand_totals = json_encode(HardgoodsInitials::getTotalForBrandByCategoryAndSubdeptAndStoreNumber($row->store_number, $row->subdept, $row->category, $row->department));

									});
									
		return($hgTotals);	
    }

    public static function getTotalForBrandByCategoryAndSubdeptAndStoreNumber($storeNumber, $subdept, $category, $department)
    {	
    
		$hgTotals = HardgoodsInitials::where('store_number', $storeNumber)
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
													subdepartment as subdept, department,
													store_number'))
									->groupBy('brand')
									->get()
									->each(function($row){
										$row->style_totals = json_encode(HardgoodsInitials::getTotalForStyleByBrandandCategoryAndSubdeptAndStoreNumber($row->store_number, $row->subdept, $row->category, $row->brand, $row->department));										
									});
		return($hgTotals);	
    }

    public static function getTotalForStyleByBrandandCategoryAndSubdeptAndStoreNumber($storeNumber, $subdept, $category, $brand, $department)
    {
    	
    	$hgTotals = HardgoodsInitials::where('store_number', $storeNumber)
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
		return($hgTotals);
    }
}
