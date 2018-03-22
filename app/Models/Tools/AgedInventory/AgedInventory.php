<?php

namespace App\Models\Tools\AgedInventory;

use Illuminate\Database\Eloquent\Model;

class AgedInventory extends Model
{
    protected $table = 'aged_inventory';
    public $timestamps = true;
    
    public static function getAllProductsByStoreNumber($storeNumber)
    {
        return Self::where("store_number", $storeNumber)->get();
    }
}
