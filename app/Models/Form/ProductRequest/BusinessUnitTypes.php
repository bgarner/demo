<?php

namespace App\Models\Form\ProductRequest;

use Illuminate\Database\Eloquent\Model;

class BusinessUnitTypes extends Model
{
    protected $table = 'form_business_unit_types';
    protected $fillable = ['business_unit'];

    public static function getBUList()
    {
    	return Self::all()
    				->pluck('business_unit', 'id')
    				->toArray();
    }
}
