<?php

namespace App\Models\Form;

use Illuminate\Database\Eloquent\Model;

class FormActivityLog extends Model
{
    protected $table = 'form_activity_log';

    protected $fillable = ['form_data_id', 'log'];
}
