<?php

namespace App\Models\Task;

use Illuminate\Database\Eloquent\Model;

class TaskStoreGroup extends Model
{
    protected $table = 'task_store_group';

    protected $fillable = ['task_id', 'store_group_id'];
}
