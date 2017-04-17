<?php

namespace App\Models\Task;

use Illuminate\Database\Eloquent\Model;

class TaskStatusTypes extends Model
{
    protected $table = 'task_status_types';

    protected $fillable = ['status_title'];

    public static function getTaskStatusList()
    {
    	return TaskStatusTypes::all()->pluck('status_title', 'id');
    }

}
