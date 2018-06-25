<?php

namespace App\Models\Form;

use Illuminate\Database\Eloquent\Model;

class FormResolution extends Model
{
    protected $table = 'form_resolution_code';
    protected $fillable = ['form_id', 'resolution_code'];
}
