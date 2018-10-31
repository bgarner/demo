<?php

namespace App\Models\StoreVisitReport;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use App\Models\Utility\Utility;

class StoreVisitReportInstance extends Model
{
    protected $table = 'store_visit_report_instance';
    protected $fillable = ['store_number', 'dm_id', 'is_draft', 'submitted_at'];

    public static function saveReport($request)
    {
    	$dm_id = \Auth::user()->id;
    	$newStoreVisitReport = StoreVisitReportInstance::create([
    		'store_number' => $request->store_number,
    		'dm_id'        => $dm_id,
    		'is_draft'     => $request->is_draft,
    	]);

    	if(!$request->is_draft){
    		$storeVisitReport->update([
    			'submitted_at' => Carbon::now()->toDateTimeString()
    		]);
    	}

    	StoreVisitReportResponse::updateResponses($newStoreVisitReport->id, $request->all());
    	return $newStoreVisitReport;
    }

    public static function updateReport($id, $request)
    {
    	\Log::info($request);
    	$storeVisitReport = StoreVisitReportInstance::find($id);
    	$storeVisitReport->update([
    		'store_number' => $request->store_number,
    		'is_draft' => $request->is_draft
    	]);

    	if(!$request->is_draft){
    		$storeVisitReport->update([
    			'submitted_at' => Carbon::now()->toDateTimeString()
    		]);
    	}

    	StoreVisitReportResponse::updateResponses($id, $request->all());
    	return;

    }

    public static function getReportById($id)
    {
    	$report = StoreVisitReportInstance::find($id);
        if($report->submitted_at){
            $report->prettySubmitted = Utility::prettifyDateWithTime($report->submitted_at);
            $report->sinceSubmitted = Utility::getTimePastSinceDate($report->submitted_at);
        }
        $report->fields = StoreVisitReportField::getStoreVisitReportFields();
    	$report->fieldResponses = StoreVisitReportResponse::getFieldResonseMap($id);

    	return $report;
    	
    }

    public static function getReportsByManager()
    {
        $user_id = \Auth::user()->id;
        $role = \Auth::user()->role;

        if($role == 'District Manager'){
            $reports = Self::where('dm_id', $user_id)
                        ->get();

        }
        else if($role == 'AVP'){

        }
        else if($role == 'Exec'){

        }

        return $reports->each(function($report){
                            if($report->submitted_at){
                                $report->prettySubmitted = Utility::prettifyDateWithTime($report->submitted_at);
                            }
                            $report->prettyUpdated = Utility::prettifyDateWithTime($report->updated_at);
                        });

    }

    public static function deleteReport($id)
    {
        $report = StoreVisitReportInstance::find($id);
        if($report->is_draft){
            StoreVisitReportResponse::where('report_instance_id', $id)->delete();
            $report->delete();
        }

        return;
    }
}
