<?php

namespace App\Models\Task;

use Illuminate\Database\Eloquent\Model;

class TasklistStoreGroup extends Model
{
    protected $table = 'tasklist_store_group';

    protected $fillable = ['tasklist_id', 'store_group_id'];
}
