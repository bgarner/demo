<?php

namespace App\Models\Form;

use Illuminate\Database\Eloquent\Model;

class FormStatusMap extends Model
{
    protected $table = 'form_status_map';
    protected $fillable = ['form_id', 'status_id'];

    public static function getStatusCodesByForm($id)
    {
    	return Self::join('form_status_code', 'form_status_map.status_id', 'form_status_code.id')
    				->where('form_status_code.form_id', $id)
    				->get();
    }
}
