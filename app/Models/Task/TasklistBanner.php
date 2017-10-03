<?php

namespace App\Models\Task;

use Illuminate\Database\Eloquent\Model;

class TasklistBanner extends Model
{
    protected $table = 'tasklist_banner';
    protected $fillable = ['tasklist_id', 'banner_id'];
}
