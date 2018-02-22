<?php

namespace App\Models\Form;

use Illuminate\Database\Eloquent\Model;

class FormData extends Model
{
    protected $table = 'form_data';
    protected $fillable = ['store_number', 'unique_form_id', 'submitted_by', 'form_data', 'form_name', 'form_version'];

    
}
