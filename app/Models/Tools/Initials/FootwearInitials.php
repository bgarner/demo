<?php

namespace App\Models\Tools\Initials;

use Illuminate\Database\Eloquent\Model;
use App\Models\Tools\Initials\Initials;

class FootwearInitials extends Initials
{
    public static function getTotalForGenderByStore($storeNumber, $division)
    {
    	Initials::getTotalForGenderByStore($storeNumber, $division);
		return($fwTotals);
    }
}
