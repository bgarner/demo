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
}
