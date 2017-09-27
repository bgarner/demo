<?php

namespace App\Models\Task;

use Illuminate\Database\Eloquent\Model;
use App\Models\Utility\Utility;
use App\Models\StoreApi\Banner;

class TasklistTarget extends Model
{
    protected $table = 'tasklist_target';

    protected $fillable = ['tasklist_id', 'store_id'];

    public static function updateTargetStores($id, $request)
	{	
		$target_stores = $request['target_stores'];
		$allStores = $request['all_stores'];

		if($allStores == 'on') {
            TasklistTarget::where('tasklist_id', $id)->delete();
            $tasklist = Tasklist::find($id);
            $tasklist->all_stores = 1;
            $tasklist->save();
        }
        else{
        	TasklistTarget::where('tasklist_id', $id)->delete();
			if (count($target_stores) > 0) {
				foreach ($target_stores as $store) {
					TasklistTarget::create([
						'tasklist_id'   => $id,
						'store_id'  	=> $store
					]);

				} 
			}
			if(!in_array('0940', $target_stores)){
				Utility::addHeadOffice($id, 'tasklist_target', 'tasklist_id');
			}
			$task = Tasklist::find($id);
        	$task->all_stores = 0;
        	$task->save();            
			
		}

		return;

	}

	public static function getTargetStoresByTasklistId($id)
	{
		$tasklist = Tasklist::find($id);

        if(isset($tasklist->all_stores) && $tasklist->all_stores){
            $banner = 1;
            $stores = Banner::getStoreDetailsByBannerid($banner)->pluck('store_number')->toArray();
        }
        else{
            $stores = TasklistTarget::where('tasklist_id', $id)
                                ->get()
                                ->pluck('store_id')
                                ->toArray();    
        }


        return $stores;
	}
}
