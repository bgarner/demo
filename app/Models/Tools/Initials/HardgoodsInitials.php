<?php

namespace App\Models\Tools\Initials;

use Illuminate\Database\Eloquent\Model;
use App\Models\Tools\Initials\Initials;

class HardgoodsInitials extends Initials
{
    public static function getTotalForDeptByStore($storeNumber, $division)
    {
    	$storeNumber = ltrim($storeNumber, 'A');
		$storeNumber = ltrim($storeNumber, '0');

		$fwTotals = Initials::where('store_number', $storeNumber)
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
										
										$row->subdept_totals =  json_encode(Self::getTotalForSubdeptByStore($row->store_number, $division, $row->department));
									});	
		return($fwTotals);
    }
}
