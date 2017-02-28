<?php

namespace App\Models\Task;

use Illuminate\Database\Eloquent\Model;

class TaskCreator extends Model
{
    protected $table = 'task_creator';

    protected $fillable = ['task_id', 'creator_id'];

    public static function updateTaskCreator($task_id, $creator_id)
    {
    	TaskCreator::create([
    			'task_id' => $task_id,
    			'creator_id' => $creator_id
    		]);
    }
}
