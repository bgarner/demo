<?php

namespace App\Models\Tools\AgedInventory;

use Illuminate\Database\Eloquent\Model;

class AgedInventory extends Model
{
    protected $table = 'aged_inventory';
    public $timestamps = true;
    
    // public function scopeIsNotFootwearLessThanFive($query)
    // {
    //     return $query->where('category', '!=', 'FOOTWEAR')->where('on_hand', '<', 5);
    // }

    public static function getAllProductsByStoreNumber($storeNumber)
    {
        return Self::where("store_number", $storeNumber)
                    ->where('on_hand', '>', 0)
                    ->where(function($query){
                        $query->where(function($q){
                            $q->where('on_hand', '>', 5)->where('category', 'FOOTWEAR');
                        })->orWhere('category', '!=', 'FOOTWEAR');
                    //})->toSql();
                    })->get();
    }
}
