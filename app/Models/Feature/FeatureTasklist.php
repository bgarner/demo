<?php

namespace App\Models\Feature;

use Illuminate\Database\Eloquent\Model;
use App\Models\Task\TasklistTask;

class FeatureTasklist extends Model
{
    protected $table = 'feature_tasklist';
    protected $fillable = ['feature_id', 'tasklist_id'];

    public static function getTasklistsByFeatureId($feature_id)
    {
    	return FeatureTasklist::join('tasklists', 'tasklists.id', '=', 'feature_tasklist.tasklist_id')
    					->where('feature_id', $feature_id)
    					->select('tasklists.*')
    					->get()
    					->each(function($tasklist){
    						$tasklist->tasks = TasklistTask::join('tasks', 'tasks.id', '=', 'tasklist_tasks.task_id')
    														->where('tasklist_tasks.tasklist_id', $tasklist->id)
    														->select('tasks.*')
    														->get();
    					});

    }

    public static function updateFeatureTasklists($tasklists, $feature_id)
    {
    	if(FeatureTasklist::where('feature_id', $feature_id)->first()){
            $feature = FeatureTasklist::where('feature_id', $feature_id)->delete();
        }
        if (isset($tasklists)) {   
            
            foreach ($tasklists as $tasklist) {
                FeatureTasklist::create([
                    'feature_id' => $feature_id,
                    'tasklist_id' => intval($tasklist)
                    ]);
            }
        }
    }

    
}
