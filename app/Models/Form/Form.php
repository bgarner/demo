<?php

namespace App\Models\Form;

use Illuminate\Database\Eloquent\Model;

class Form extends Model
{
    protected $table = 'forms';

    protected $fillable = ['form_name', 'version', 'form_structure'];

    public static function getFormsByAdminId($id)
    {
        return Form::all();
    }
}
