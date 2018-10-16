<?php

namespace App\Models\Surveys;

use Illuminate\Database\Eloquent\Model;
use App\Models\StoreApi\StoreInfo;
use Carbon\Carbon;

class Survey extends Model
{
    public static function getSurveysByStore($store_id)
    {
        $now = Carbon::now()->toDatetimeString();
        $banner_id = StoreInfo::getStoreInfoByStoreId($store_id)->banner_id;

        $allStoreSurveys = Survey::where('all_stores', 1)
                            ->where('start', '<=', $now )
                            ->where('end', '>=', $now)
                            ->get();

        $targetedSurveys = Survey::join('survey_target', 'survey_target.survey' , '=', 'surveys.id')
                        ->where('survey_target.store_id', '=', $store_id)
                        ->where('surveys.start', '<=', $now )
                        ->where(function($query) use ($now) {
                            $query->where('surveys.end', '>=', $now)
                                ->orWhere('surveys.end', '=', '0000-00-00 00:00:00' )
                                ->orWhere('surveys.end', '=', NULL ); 
                            })
                        ->select('surveys.*')
                        ->get();

        $surveys = $allStoreSurveys->merge($targetedSurveys)->sortByDesc('start');
        return $surveys;

    }
}
