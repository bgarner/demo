<?php

namespace App\Models\Task;

use Illuminate\Database\Eloquent\Model;

class StoreStatusTypes extends Model
{
    protected $table = 'task_store_status_types';

    public static function getTaskStatusTypeId($currentStatus)
    {
    	$updatedStatus = Self::where('status_title', '!=' , $currentStatus)->first();
    	return $updatedStatus;
    }
}
