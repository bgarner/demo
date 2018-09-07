<?php

namespace App\Http\Controllers\Feature;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Feature\FeatureTasklist;
use App\Models\Task\Task;

class FeatureTasklistController extends Controller
{
    public function show($storeNumber, $featureId)
    {
    	\Log::info('requesting to update feature tasklist');
    	$tasklists = FeatureTasklist::getTasklistsByFeatureId($featureId, $storeNumber);
    	return view('site.feature.tasklist-partial')->with('tasklists', $tasklists);
    }

    public function update(Request $request, $storeNumber, $featureId, $taskId )
    {
    	return Task::updateTaskStoreStatus($request, $storeNumber, $taskId);
    }
}
