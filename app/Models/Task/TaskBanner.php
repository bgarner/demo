<?php

namespace App\Models\Task;

use Illuminate\Database\Eloquent\Model;

class TaskBanner extends Model
{
    protected $table = 'task_banner';
    protected $fillable = ['task_id', 'banner_id'];
}
