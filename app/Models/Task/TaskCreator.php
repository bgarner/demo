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

    public static function getTaskCreatorForTask($task_id)
    {
    	$user = TaskCreator::join('users', 'users.id', '=', 'task_creator.creator_id')
    				->where('task_id', $task_id)
    				->select('users.firstname', 'users.lastname')
    				->first();

    	$user = $user->firstname . ' ' . $user->lastname;

    	return ($user);
    }
}
