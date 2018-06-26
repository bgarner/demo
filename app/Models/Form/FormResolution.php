<?php

namespace App\Models\Form;

use Illuminate\Database\Eloquent\Model;

class FormResolution extends Model
{
    protected $table = 'form_resolution_code';
    protected $fillable = ['form_id', 'resolution_code'];

    public static function getResolutionCodesByFormId($form_id)
    {
    	return Self::where('form_id', $form_id)->get()->pluck('resolution_code', 'id')->toArray();
    }
}
