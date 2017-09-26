<?php

namespace App\Models\Task;

use Illuminate\Database\Eloquent\Model;

class TasklistTask extends Model
{
    protected $table = 'tasklist_tasks';

    protected $fillable = ['tasklist_id', 'task_id'];
}
