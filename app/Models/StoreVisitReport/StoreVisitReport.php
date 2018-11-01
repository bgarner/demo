<?php

namespace App\Models\StoreVisitReport;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use App\Models\Utility\Utility;
use App\Models\StoreApi\RegionDistrict;

class StoreVisitReport extends Model
{
    protected $table = 'store_visit_report_instance';
    protected $fillable = ['store_number', 'dm_id', 'is_draft', 'submitted_at'];

    public static function saveReport($request)
    {
    	$dm_id = \Auth::user()->id;
    	$newStoreVisitReport = StoreVisitReport::create([
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
    	$storeVisitReport = StoreVisitReport::find($id);
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
    	$report = StoreVisitReport::find($id);
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
            
            $dmList = Utility::getDmListForAvp($user_id);
            $reports = Self::whereIn('dm_id', $dmList)
                        ->where('is_draft', 0)
                        ->get();
        }
        else if($role == 'Exec'){
            $reports = Self::where('is_draft', 0)->get();
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
        $report = StoreVisitReport::find($id);
        if($report->is_draft){
            StoreVisitReportResponse::where('report_instance_id', $id)->delete();
            $report->delete();
        }

        return;
    }
}
