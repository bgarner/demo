<?php

namespace App\Models\Alert;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use DB;
use App\Models\Utility\Utility;
use App\Models\Document\Document;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Alert\AlertTarget;
use App\Models\Auth\User\UserSelectedBanner;
use App\Models\StoreApi\StoreInfo;
use App\Models\Validation\AlertValidator;

class Alert extends Model
{
    use SoftDeletes;
    protected $table = 'alerts';


    protected $fillable = ['banner_id', 'document_id', 'alert_type_id', 'alert_start', 'alert_end'];
    protected $dates = ['deleted_at'];

    public static function validateAlert($request)
    {
         $validateThis = [
            'document_id'   => $request['document_id'],
            'alert_type_id' => $request['alert_type_id']
        ];

        \Log::info($validateThis);

        $v = new AlertValidator();
        $validationResult = $v->validate($validateThis);
        return $validationResult;
    }

    public static function getAllAlerts()
    {
    	$banner = UserSelectedBanner::getBanner();
        $alerts = Alert::join('documents', 'alerts.document_id' , '=', 'documents.id')
    			->join('alert_types', 'alert_types.id', '=', 'alerts.alert_type_id')
    			->where('alerts.banner_id', $banner->id)
    			->select('alerts.*', 'alert_types.name as alert_type',
                         'documents.id as document_id',
                         'documents.original_filename as document_name',
                         'documents.start as start',
                         'documents.filename as filename',
                         'documents.end as end',
                         'documents.title as document_title',
                         'documents.original_extension as document_extension',
                         'documents.all_stores')
    			->get();

    	foreach ($alerts as $alert) {

    		if(!$alert->all_stores){
                $target_stores = Document::join('document_target', 'document_target.document_id', '=', 'documents.id')
                                        ->where('document_target.document_id', $alert->document_id)
                                        // ->where('document_target.deleted_at', null)
                                        ->pluck('store_id')
                                        ->toArray();

                $alert->count_target_stores = count($target_stores);
                $alert->target_stores = implode( ", ", $target_stores );
                unset($target_stores);    
            }
            
            
            $now = Carbon::now()->toDatetimeString();
            $alert->now = $now;
            $alert->active = "No";
            if ($alert->start <= $now && 
                ($alert->end >= $now || $alert->end == '0000-00-00 00:00:00' ||$alert->end == NULL)
                ) {
                $alert->active = "Yes";
            }

            $alert->prettyStart = Utility::prettifyDate($alert->start);
            $alert->prettyEnd = Utility::prettifyDate($alert->end);
            $alert->modalLink = Utility::getModalLink($alert->filename, $alert->document_name, $alert->document_extension, $alert->document_id, 1, 0);
            $alert->icon = Utility::getIcon($alert->document_extension);
    	}

    	return $alerts;
    }

    public static function getAlertCountByStoreNumber($request, $storeNumber)
    {
        
        if (isset($request['archives']) && $request['archives']) {
            return Alert::getAllAlertCountByStore($storeNumber);
        }
        else{
            return Alert::getActiveAlertCountByStore($storeNumber);    
        }
    }

    public static function getActiveAlertCountByStore($store_id)
    {
        $now = Carbon::now()->toDatetimeString();
        $banner_id = StoreInfo::getStoreInfoByStoreId($store_id)->banner_id;

        $allStoreAlertCount = Alert::join('documents', 'documents.id', '=', 'alerts.document_id')
                                    ->where('documents.all_stores', 1)
                                    ->where('alerts.banner_id', $banner_id)
                                    ->where('documents.start', '<=', $now )
                                    ->where(function($query) use ($now) {
                                        $query->where('documents.end', '>=', $now)
                                            ->orWhere('documents.end', '=', '0000-00-00 00:00:00' )
                                            ->orWhere('documents.end', '=', NULL ); 
                                    })
                                    ->count();


        $targetAlertsCount = Alert::join('document_target', 'alerts.document_id' , '=', 'document_target.document_id')
                            ->join('documents', 'documents.id', '=', 'alerts.document_id')
                            ->where('document_target.store_id', $store_id)
                            ->where('documents.start', '<=', $now )
                            ->where(function($query) use ($now) {
                                $query->where('documents.end', '>=', $now)
                                    ->orWhere('documents.end', '=', '0000-00-00 00:00:00' )
                                    ->orWhere('documents.end', '=', NULL ); 
                            })
                            ->count();
        
        $alert_count = $allStoreAlertCount + $targetAlertsCount;
        return $alert_count;
    }

    public static function getAllAlertCountByStore($store_id)
    {
        $banner_id = StoreInfo::getStoreInfoByStoreId($store_id)->banner_id;
        $allStoreAlertCount = Alert::join('documents', 'documents.id', '=', 'alerts.document_id')
                                    ->where('documents.all_stores', 1)->where('alerts.banner_id', $banner_id)->count();

        $targetAlertsCount = Alert::join('document_target', 'alerts.document_id' , '=', 'document_target.document_id')
                            ->where('store_id', $store_id)
                            ->count();
 
        $alert_count = $allStoreAlertCount + $targetAlertsCount;

        return $alert_count;
    }    

    public static function getActiveAlertCountByCategory($storeNumber, $alertId)
    {
        $banner_id = StoreInfo::getStoreInfoByStoreId($storeNumber)->banner_id;
        
        $now = Carbon::now()->toDatetimeString();
        
        $allStoreAlertCount = Alert::join('documents', 'documents.id', '=', 'alerts.document_id')
                                    ->where('alerts.banner_id', $banner_id)
                                    ->where('documents.all_stores', 1)
                                    ->where('documents.start', '<=', $now )
                                    ->where(function($query) use ($now) {
                                        $query->where('documents.end', '>=', $now)
                                            ->orWhere('documents.end', '=', '0000-00-00 00:00:00' )
                                            ->orWhere('documents.end', '=', NULL ); 
                                    })
                                    ->where('alerts.alert_type_id', $alertId)
                                    ->count();
        
        $targetedAlertCount = Alert::join('document_target', 'alerts.document_id' , '=', 'document_target.document_id')
                                    ->join('documents', 'documents.id', '=', 'alerts.document_id')
                                    ->where('document_target.store_id', $storeNumber)
                                    ->where('alerts.alert_type_id', $alertId)
                                    ->where('documents.start', '<=', $now )
                                    ->where(function($query) use ($now) {
                                        $query->where('documents.end', '>=', $now)
                                        ->orWhere('documents.end', '=', '0000-00-00 00:00:00' )
                                        ->orWhere('documents.end', '=', NULL ); 
                                        })
                                    ->count();

        $count = $allStoreAlertCount + $targetedAlertCount;
        return $count;
  
    }


    public static function getAllAlertCountByCategory($storeNumber, $alertId)
    {
        $banner_id = StoreInfo::getStoreInfoByStoreId($storeNumber)->banner_id;

        $allStoreAlertCount = Alert::join('documents', 'documents.id', '=', 'alerts.document_id')
                                    ->where('documents.all_stores', 1)
                                    ->where('alerts.alert_type_id', $alertId)
                                    ->where('alerts.banner_id', $banner_id)
                                    ->count();

        $targetedAlertCount = Alert::join('document_target', 'alerts.document_id' , '=', 'document_target.document_id')
                                    ->where('document_target.store_id', $storeNumber)
                                    ->where('alerts.alert_type_id', $alertId)
                                    ->count();                            
        $count = $allStoreAlertCount + $targetedAlertCount;
        return $count;
    }


    public static function getAlertsByStoreNumber($request, $storeNumber)
    {
        $isValidAlertType = AlertType::isValidAlertType($request['type']);

        $alerts = [];
        if($isValidAlertType){
            $alerts = Alert::getActiveAlertsByCategory($request['type'], $storeNumber);
        
        }
        else{
            $alerts = Alert::getActiveAlertsByStore($storeNumber);
        }

        if (isset($request['archives']) && $request['archives']) {
            
            if($isValidAlertType){
                $archivedAlerts = Alert::getArchivedAlertsByCategory($request['type'], $storeNumber);
                foreach ($archivedAlerts as $aa) {
                    $alerts->add($aa);
                }
            }
            else{

                $archivedAlerts = Alert::getArchivedAlertsByStore($storeNumber);
                foreach ($archivedAlerts as $aa) {
                    $alerts->add($aa);
                }
            }
        }

        return $alerts;
    }
    
    public static function getActiveAlertsByStore($store_id)
    {

        $now = Carbon::now()->toDatetimeString();
        $banner_id = StoreInfo::getStoreInfoByStoreId($store_id)->banner_id;
        
        $allStoreAlerts = Alert::join('documents', 'alerts.document_id' , '=', 'documents.id')
                        ->where('documents.all_stores', 1)
                        ->where('documents.start', '<=', $now )
                        ->where('alerts.banner_id', $banner_id)
                        ->where(function($query) use ($now) {
                            $query->where('documents.end', '>=', $now)
                                ->orWhere('documents.end', '=', '0000-00-00 00:00:00' )
                                ->orWhere('documents.end', '=', NULL ); 
                            })
                        ->select('alerts.*', 'documents.start as start', 'documents.end as end')
                        ->get();
        
        $targetedAlerts = Alert::join('documents', 'alerts.document_id' , '=', 'documents.id')
                        ->join('document_target' , 'document_target.document_id' , '=', 'alerts.document_id')
                        ->where('document_target.store_id', '=', $store_id)
                        ->where('documents.start', '<=', $now )
                        ->where(function($query) use ($now) {
                            $query->where('documents.end', '>=', $now)
                                ->orWhere('documents.end', '=', '0000-00-00 00:00:00' )
                                ->orWhere('documents.end', '=', NULL ); 
                            })
                        ->select('alerts.*', 'documents.start as start', 'documents.end as end')
                        ->get();

        $alerts = $allStoreAlerts->merge($targetedAlerts)->sortByDesc('start');

        if (count($alerts) >0) {
            Alert::addStoreViewData($alerts);
        }

        return $alerts;
    }

    public static function getActiveAlertsByCategory($alert_type, $store_id)
    {
        $now = Carbon::now()->toDatetimeString();
        
        $banner_id = StoreInfo::getStoreInfoByStoreId($store_id)->banner_id;
        
        $allStoreAlerts = Alert::join('documents', 'alerts.document_id' , '=', 'documents.id')
                        ->join('alert_types', 'alert_types.id', '=', 'alerts.alert_type_id')
                        ->where('documents.all_stores', 1)
                        ->where('alerts.banner_id', $banner_id)
                        ->where('documents.start', '<=', $now )
                        ->where('documents.deleted_at', '=', NULL)
                        ->where(function($query) use ($now) {
                            $query->where('documents.end', '>=', $now)
                                ->orWhere('documents.end', '=', '0000-00-00 00:00:00' )
                                ->orWhere('documents.end', '=', NULL ); 
                        })
                        ->where('alert_type_id' , $alert_type)
                        ->select('alerts.*', 'documents.start as start', 'documents.end as end')
                        ->get();

        
        $targetedAlerts = Alert::join('documents', 'alerts.document_id' , '=', 'documents.id')
                        ->join('document_target' , 'document_target.document_id' , '=', 'alerts.document_id')
                        ->join('alert_types', 'alert_types.id', '=', 'alerts.alert_type_id')
                        ->where('document_target.store_id', '=', $store_id)
                        ->where('documents.start', '<=', $now )
                        ->where('documents.deleted_at', '=', NULL)
                        ->where(function($query) use ($now) {
                            $query->where('documents.end', '>=', $now)
                                ->orWhere('documents.end', '=', '0000-00-00 00:00:00' )
                                ->orWhere('documents.end', '=', NULL ); 
                        })
                        ->where('alert_type_id' , $alert_type)
                        ->select('alerts.*', 'documents.start as start', 'documents.end as end')
                        ->get();
        
        $alerts = $allStoreAlerts->merge($targetedAlerts)->sortByDesc('start');

        if (count($alerts) >0) {
            Alert::addStoreViewData($alerts);
        }

        return $alerts;
    }

    public static function getArchivedAlertsByStore($store_id)
    {
        $now = Carbon::now()->toDatetimeString();

        $banner_id = StoreInfo::getStoreInfoByStoreId($store_id)->banner_id;
        
        $allStoreAlerts = Alert::join('documents', 'alerts.document_id', '=', 'documents.id')
                        ->where('documents.all_stores', 1)
                        ->where('alerts.banner_id', $banner_id)
                        ->where('documents.end', '<=', $now)
                        ->where('documents.end', '!=', '0000-00-00 00:00:00')
                        ->where('documents.end', '!=', NULL)
                        ->where('documents.deleted_at', '=', NULL)
                        ->select('alerts.*', 'documents.start as start', 'documents.end as end')
                        ->get();

        
        $targetedAlerts = Alert::join('documents', 'alerts.document_id', '=', 'documents.id')
                        ->join('document_target', 'alerts.document_id', '=', 'document_target.document_id')
                        ->where('document_target.store_id', '=', $store_id)
                        ->where('documents.end', '<=', $now)
                        ->where('documents.end', '!=', '0000-00-00 00:00:00')
                        ->where('documents.end', '!=', NULL)
                        ->where('documents.deleted_at', '=', NULL)
                        ->select('alerts.*', 'documents.start as start', 'documents.end as end')
                        ->get();

        $alerts = $allStoreAlerts->merge($targetedAlerts)->sortByDesc('start');

        if (count($alerts) >0) {
            Alert::addStoreViewData($alerts);
            foreach ($alerts as $a) {
                $a->archived = true;
            }
        }

        return $alerts;
    }

    public static function  getArchivedAlertsByCategory($alert_type, $store_id) {
        
        $now = Carbon::now()->toDatetimeString();

        $banner_id = StoreInfo::getStoreInfoByStoreId($store_id)->banner_id;

        $allStoreAlerts = Alert::join('documents', 'alerts.document_id' , '=', 'documents.id')
                        ->join('alert_types', 'alert_types.id', '=', 'alerts.alert_type_id')
                        ->where('alerts.banner_id', $banner_id)
                        ->where('documents.all_stores', 1)
                        ->where('documents.end', '<=', $now)
                        ->where('documents.end', '!=', '0000-00-00 00:00:00')
                        ->where('documents.end', '!=', NULL)
                        ->where('alert_type_id' , $alert_type)
                        ->select('alerts.*', 'documents.start as start', 'documents.end as end')
                        ->get();

        $targetedAlerts = Alert::join('documents', 'alerts.document_id' , '=', 'documents.id')
                        ->join('document_target' , 'document_target.document_id' , '=', 'alerts.document_id')
                        ->join('alert_types', 'alert_types.id', '=', 'alerts.alert_type_id')
                        ->where('document_target.store_id', '=', $store_id)
                        ->where('documents.end', '<=', $now)
                        ->where('documents.end', '!=', '0000-00-00 00:00:00')
                        ->where('documents.end', '!=', NULL)
                        ->where('alert_type_id' , $alert_type)
                        ->select('alerts.*', 'documents.start as start', 'documents.end as end')
                        ->get();

        $alerts = $allStoreAlerts->merge($targetedAlerts)->sortByDesc('start');

        if (count($alerts) >0) {
            Alert::addStoreViewData($alerts);
            foreach ($alerts as $a) {
                $a->archived = true;
            }
        }

        return $alerts;
    }

    public static function getActiveAlertsForStoreList($storeNumbersArray)
      {
         $now = Carbon::now()->toDatetimeString();
         $alerts = Alert::join('document_target', 'document_target.document_id' ,  '=', 'alerts.document_id')
                        ->join('documents', 'documents.id', '=', 'alerts.document_id')
                        ->join('alert_types', 'alerts.alert_type_id', '=', 'alert_types.id') 
                        ->whereIn('document_target.store_id', $storeNumbersArray)
                        ->where('documents.start', '<=', $now )
                        ->where(function($query) use ($now) {
                            $query->where('documents.end', '>=', $now)
                                ->orWhere('documents.end', '=', '0000-00-00 00:00:00' )
                                ->orWhere('documents.end', '=', NULL ); 
                        })
                        ->whereNull('alerts.deleted_at')
                        ->whereNull('documents.deleted_at')
                        ->select('documents.*', 'alerts_target.store_id', 'alert_types.name')
                       ->get()
                       ->toArray();
         $compiledAlerts = [];

         foreach ($alerts as $alert) {
            $index = array_search($alert['id'], array_column($compiledAlerts, 'id'));
            if(  $index !== false ){
               array_push($compiledAlerts[$index]->stores, $alert["store_id"]);
            }
            else{
               
               $alert["stores"] = [];
               array_push( $alert["stores"] , $alert["store_id"]);
               array_push( $compiledAlerts , (object) $alert);
            }
         }
         return (object)($compiledAlerts);
      }       

    public static function addStoreViewData($alerts)
    {

        foreach($alerts as $a){
            
                $a->prettyDate =  Utility::prettifyDate($a->start);
                $a->since =  Utility::getTimePastSinceDate($a->start);
                $doc = Document::getDocumentById($a->document_id);
                $alertType = AlertType::find($a->alert_type_id);
                $a->icon = Utility::getIcon($doc->original_extension);
                $a->link_with_icon = Utility::getModalLink($doc->filename, $doc->title, $doc->original_extension, $doc->id, 1);
                $a->link = Utility::getModalLink($doc->filename, $doc->title, $doc->original_extension, $doc->id, 0);
                $a->title = $doc->title;
                $a->filename = $doc->filename;
                $a->description = $doc->description;
                $a->original_extension = $doc->original_extension;
                $a->alertTypeName = $alertType->name;
                
            }
    }


    public static function createAlert($request)
    {
        
        $validate = Alert::validateAlert($request);

        if($validate['validation_result'] == 'false') {
            \Log::info($validate);
            return json_encode($validate);
        }

        return Self::markDocumentAsAlert($request, $request['document_id']);
    }

    public static function markDocumentAsAlert($request, $id)
    {
        if (Alert::where('document_id', $id)->first()) {
            
            $alert = Alert::where('document_id', $id)->first();

            $alert['alert_type_id'] = $request['alert_type_id'];

            $alert->save();

        }
        else {
            $alert = Alert::create([

            'document_id'   => $id,
            'alert_type_id' => $request['alert_type_id'],
            'alert_start'   => null,
            'alert_end'     => null,
            'banner_id'     => $request['banner_id']
            ]);

        }
        
        
        return $alert;
    }

    public static function deleteAlert($document_id)
    {
        $alert = Alert::where('document_id', $document_id)->first();
        if ($alert) {
            $alert->delete();
            \DB::table('alerts_target')->where('alert_id', $alert->id)->delete();
        }
        return;
    }

    public static function getAlertCategoryName($id)
    {
        if(isset($id) && !empty($id)){

            if( AlertType::find($id) ){
                return AlertType::where('id', $id)->first()->name;   
            }
         }
    }

}
