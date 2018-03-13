<?php

namespace App\Models\Form;

use Illuminate\Database\Eloquent\Model;

class FormInstanceStatusMap extends Model
{
    protected $table = 'form_instance_status';
    protected $fillable = ['form_data_id', 'status_code_id'];
}
