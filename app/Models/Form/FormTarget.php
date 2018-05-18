<?php

namespace App\Models\Form;

use Illuminate\Database\Eloquent\Model;

class FormTarget extends Model
{
    protected $table = 'form_target';
    protected $fillable = ['form_id', 'store_id'];

    public static function isFormComponentVisible($store_id)
    {
    	
    	if( Self::where('store_id', $store_id)->first()){

    		return true;
    	}
    	return false;
    }
}
