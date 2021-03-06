<?php

namespace App\Models\Form;

use Illuminate\Database\Eloquent\Model;

class FormStatusMap extends Model
{
    protected $table = 'form_status_map';
    protected $fillable = ['form_id', 'status_id'];

    public static function getStatusCodesByForm($id)
    {
    	$codes = Self::join('form_status_code', 'form_status_map.status_id', 'form_status_code.id')
    				->where('form_status_map.form_id', $id)
                    ->where('form_status_code.visible', 1)
                    ->select('form_status_code.id', 'form_status_code.admin_status')
    				->get();

    	return $codes;
    }
}
