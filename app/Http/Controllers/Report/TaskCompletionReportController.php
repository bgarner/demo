<?php

namespace App\Http\Controllers\Report;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\StoreApi\District;
use App\Models\Task\Task;

class TaskCompletionReportController extends Controller
{
    public function index()
    {
        $districts = District::getAllDistricts();

        $tasksByStore = \DB::select(\DB::raw('Select `store_id`, GROUP_CONCAT(`task_id`) as tasks, count(`task_id`) from `tasks` left join `tasks_target` on `tasks`.`id` = `tasks_target`.`task_id` where  `store_id` is not null GROUP BY `store_id`'));

        foreach ($tasksByStore as $record) {
            $record->tasks = explode(',' , $record->tasks);
        }

        $tasksByStoreGroup = \DB::select(\DB::raw('Select `stores`, GROUP_CONCAT(`task_id`) as tasks, count(`task_id`) from `tasks` left join `task_store_group` on `tasks`.`id` = `task_store_group`.`task_id` inner join `custom_store_group` on `task_store_group`.`store_group_id` = `custom_store_group`.`id` where `store_group_id` is not null GROUP BY `store_group_id`'));

        foreach ($tasksByStoreGroup as $record) {
            $record->stores = unserialize($record->stores);
            $record->tasks = explode(',' , $record->tasks);
        }

        dd($tasksByStoreGroup);
   
//  Select `store_group_id`, GROUP_CONCAT(`task_id`) 
// from `tasks`
// left join `task_store_group` on `tasks`.`id` = `task_store_group`.`task_id`
// --  where `publish_date` > '2018-10-01 00:00:00' and `publish_date` <'2018-10-31 23:59:59'
//  GROUP BY `store_group_id`;
 
//  Select `banner_id`, GROUP_CONCAT(`task_id`), count(`task_id`) 
// from `tasks`
// left join `task_banner` on `tasks`.`id` = `task_banner`.`task_id`
// --  where `publish_date` > '2018-10-01 00:00:00' and `publish_date` <'2018-10-31 23:59:59'
//  GROUP BY `banner_id`;

        dd($districts);
    }
}
