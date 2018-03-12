<?php

namespace App\Models\Form;

use Illuminate\Database\Eloquent\Model;

class Status extends Model
{
    protected $table = 'form_status_code';
    protected $fillable = ['form_id', 'store_status', 'admin_status', 'icon', 'colour'];
}
