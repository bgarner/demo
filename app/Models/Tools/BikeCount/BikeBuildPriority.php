<?php

namespace App\Models\Tools\BikeCount;

use Illuminate\Database\Eloquent\Model;

class BikeBuildPriority extends Model
{
    protected $table = 'bike_build_priority';

    public static function isPriority($style)
    {
        $isPriority = BikeBuildPriority::where('style', $style)->get();
        if(count($isPriority) > 0){
            return $isPriority;
        }
        return false;
    }
}
