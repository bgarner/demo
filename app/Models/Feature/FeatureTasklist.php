<?php

namespace App\Models\Feature;

use Illuminate\Database\Eloquent\Model;
use App\Models\Task\TasklistTask;
use App\Models\Task\Tasklist;

class FeatureTasklist extends Model
{
    protected $table = 'feature_tasklist';
    protected $fillable = ['feature_id', 'tasklist_id'];

    public static function getTasklistsByFeatureId($feature_id, $storeNumber)
    {
    	$featureTasklist = FeatureTasklist::join('tasklists', 'tasklists.id', '=', 'feature_tasklist.tasklist_id')
    					->where('feature_id', $feature_id)
    					->select('tasklists.*')
    					->get()
    					->each(function($tasklist) use($storeNumber){

                            $tasklist->incompleteTasks = Tasklist::getAllIncompleteTasksByTasklistId($tasklist->id, $storeNumber);
                            $tasklist->completedTasks = Tasklist::getAllCompletedTasksByTasklistId($tasklist->id, $storeNumber);
    					});
        return ($featureTasklist);
    }

    public static function getTasklistsByFeatureIdForAdmin($feature_id)
    {
        return FeatureTasklist::join('tasklists', 'tasklists.id', '=', 'feature_tasklist.tasklist_id')
                    ->where('feature_id', $feature_id)
                    ->select('tasklists.id')
                    ->get()
                    ->toArray();
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
