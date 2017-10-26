<?php

namespace App\Models\UrgentNotice;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use App\Models\Communication\Communication;
use DB;
use App\Models\Utility\Utility;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Validation\UrgentNoticeValidator;
use App\Models\Auth\User\UserSelectedBanner;
use App\Models\StoreApi\StoreInfo;
use App\Models\Auth\User\UserBanner;
use App\Models\Tools\CustomStoreGroup;

class UrgentNotice extends Model
{
    use SoftDeletes;
    protected $table = 'urgent_notices';
    protected $fillable = ['banner_id', 'title', 'description', 'attachment_type_id', 'start', 'end', 'all_stores'];
    protected $dates = ['deleted_at'];

    public static function validateUrgentNotice($request)
    { 
        $validateThis = [ 
                        'title'              => $request['title'],
                        'start'              => $request['start'],
                        'end'                => $request['end'],
                        'attachment_type_id' => $request['attachment_type'][0],

        ];
        if ($request['target_stores'] != NULL) {
            $validateThis['target_stores'] = $request['target_stores'];
        }
        if ($request['target_banners'] != NULL) {
            $validateThis['target_banners'] = $request['target_banners'];
        }
        if ($request['store_groups'] != NULL) {
            $validateThis['store_groups'] = $request['store_groups'];
        }

        if ($request['all_stores'] != NULL) {
            $validateThis['allStores'] = $request['all_stores'];
        }

        if(isset($request['urgentnotice_documents']) && $request['urgentnotice_documents']){
            $validateThis['documents'] = $request['urgentnotice_documents'];
        }
        if(isset($request['urgentnotice_folders']) && $request['urgentnotice_folders']){
            $validateThis['folders'] = $request['urgentnotice_folders'];
        }
      
        \Log::info('*********');
        \Log::info($validateThis);
        \Log::info('*********');

        $v = new UrgentNoticeValidator();
        $validationResult =  $v->validate($validateThis);
        \Log::info($validationResult);
        return $validationResult;
       
    }


    public static function storeUrgentNotice(Request $request)
    {
    	\Log::info($request->all());
    	$validate = UrgentNotice::validateUrgentNotice($request);
        if($validate['validation_result'] == 'false') {
          return json_encode($validate);
        }

    	$title = $request->title;
    	$description = $request->description;
    	$start = $request->start;
    	$end = $request->end;
    	$attachment_type_id = $request->attachment_type_id;
    	$target_stores = $request->target_stores;
    	
    	
    	$urgentNotice = UrgentNotice::create([
    		'title'		=> $title,
    		'description' => $description,
    		'start'		=> $start,
    		'end'		=> $end,
    		'attachment_type_id'=>$attachment_type_id
    	]);

        UrgentNoticeFolder::addFolders($request['urgentnotice_folders'], $urgentNotice->id);
        UrgentNoticeDocument::addDocuments($request['urgentnotice_documents'], $urgentNotice->id);
        UrgentNoticeTarget::updateTargetStores($request, $urgentNotice->id);
    	
    	return $urgentNotice;
    	
    }

    public static function updateUrgentNotice($request, $id)
    {
    
        \Log::info($request->all());
        $validate = UrgentNotice::validateUrgentNotice($request);
        if($validate['validation_result'] == 'false') {
          \Log::info($validate);
          return json_encode($validate);
        }

        $urgentNotice = UrgentNotice::find($id);

    	$title = $request->title;
    	$description = $request->description;
    	$start = $request->start;
    	$end = $request->end;	
    	$target_stores = $request->target_stores;
        
    	$urgentNotice->update([
    		'title'		=> $title,
    		'description' => $description,
    		'start'		=> $start,
    		'end'		=> $end
    	]);
    	$urgentNotice->save();

    	
    	UrgentNoticeDocument::updateDocuments($request, $id);
        UrgentNoticeFolder::updateFolders($request, $id);
        UrgentNoticeTarget::updateTargetStores($request, $id);
    	
        return $urgentNotice;

    }



    public static function deleteUrgentNotice($id)
    {
        UrgentNotice::find($id)->delete();
        UrgentNoticeTarget::where('urgent_notice_id', $id)->delete();
        UrgentNoticeDocument::where('urgent_notice_id', $id)->delete();
        UrgentNoticeFolder::where('urgent_notice_id', $id)->delete();
    }

    public static function getUrgentNoticeCount($storeNumber)
    {
        $now = Carbon::now()->toDatetimeString();

        $banner_id = StoreInfo::getStoreInfoByStoreId($storeNumber)->banner_id;

        $allStoreUrgentNoticeCount = UrgentNotice::join('urgent_notice_banner', 'urgent_notice_banner.urgent_notice_id', '=', 'urgent_notices.id')
                                                ->where('all_stores', 1)
                                                ->where('urgent_notice_banner.banner_id', $banner_id)
                                                ->where('urgent_notices.start' , '<=', $now)
                                                ->where('urgent_notices.end', '>=', $now)
                                                ->count();

        $targetedUrgentNoticeCount = UrgentNoticeTarget::join('urgent_notices','urgent_notices.id','=','urgent_notice_target.urgent_notice_id')
                                ->where('urgent_notice_target.store_id', $storeNumber)
                                ->where('urgent_notice_target.is_read', 0)
                                ->where('urgent_notices.start' , '<=', $now)
                                ->where('urgent_notices.end', '>=', $now)
                                ->count();

        $storeGroups = CustomStoreGroup::getStoreGroupsForStore($storeNumber);

        $storeGroupUrgentNotices = UrgentNotice::join('urgent_notice_store_group', 'urgent_notice_store_group.urgent_notice_id', '=', 'urgent_notices.id')
                                                ->whereIn('urgent_notice_store_group.store_group_id', $storeGroups)
                                                ->where('urgent_notices.start', '<=', $now )
                                                ->where('urgent_notices.end', '>=', $now )
                                                ->count();
        $urgentNoticeCount = $allStoreUrgentNoticeCount + $targetedUrgentNoticeCount + $storeGroupUrgentNotices;

        return $urgentNoticeCount;
    }

    public static function getUrgentNotice($id)
    {    
         $notice = UrgentNotice::find($id);
         $notice->prettyDate = Utility::prettifyDate($notice->start);
         $notice->since = Utility::getTimePastSinceDate($notice->start);
         return $notice;
    }


    public static function getActiveUrgentNoticesByStore($storeNumber)
    {
        
        $now = Carbon::now()->toDatetimeString();

        $banner_id = StoreInfo::getStoreInfoByStoreId($storeNumber)->banner_id;

        $allStoreUrgentNotice  = UrgentNotice::join('urgent_notice_banner', 'urgent_notice_banner.urgent_notice_id', '=', 'urgent_notices.id')
                                            ->where('all_stores', 1)
                                            ->where('urgent_notice_banner.banner_id', $banner_id )
                                            ->where('urgent_notices.start' , '<=', $now)
                                            ->where('urgent_notices.end', '>=', $now)
                                            ->select('urgent_notices.*')
                                            ->get();

        $targetedUrgentNotices = UrgentNoticeTarget::join('urgent_notices', 'urgent_notices.id' , '=', 'urgent_notice_target.urgent_notice_id')
                                ->where('urgent_notice_target.store_id', $storeNumber)
                                ->where('urgent_notices.start' , '<=', $now)
                                ->where('urgent_notices.end', '>=', $now)
                                ->select('urgent_notices.*')
                                ->get();

        $storeGroups = CustomStoreGroup::getStoreGroupsForStore($storeNumber);

        $storeGroupUrgentNotices = UrgentNotice::join('urgent_notice_store_group', 'urgent_notice_store_group.urgent_notice_id', '=', 'urgent_notices.id')
                                                ->whereIn('urgent_notice_store_group.store_group_id', $storeGroups)
                                                ->where('urgent_notices.start', '<=', $now )
                                                ->where('urgent_notices.end', '>=', $now )
                                                ->select('urgent_notices.*')
                                                ->get();

        $notices = $allStoreUrgentNotice->merge($targetedUrgentNotices)->merge($storeGroupUrgentNotices);              
        foreach($notices as $n){
            
            $n->since =  Utility::getTimePastSinceDate($n->start);
            $n->prettyDate =  Utility::prettifyDate($n->start);
            $preview_string = strip_tags($n->description);
            $n->trunc = Utility::truncateHtml($preview_string);
        }

        return $notices;        

    }

    public static function getActiveUrgentNoticesForStoreList($storeNumbersArray)
    {
        $now = Carbon::now()->toDatetimeString();
        $urgent_notices = UrgentNotice::join('urgent_notice_target', 'urgent_notice_target.urgent_notice_id' ,  '=', 'urgent_notices.id')
                    ->whereIn('urgent_notice_target.store_id', $storeNumbersArray)
                    ->where('urgent_notices.start', '<=', $now )
                    ->where(function($query) use ($now) {
                        $query->where('urgent_notices.end', '>=', $now)
                            ->orWhere('urgent_notices.end', '=', '0000-00-00 00:00:00' ); 
                    })
                    ->whereNull('urgent_notices.deleted_at')
                    // ->whereNull('urgent_notice_target.deleted_at')
                    ->select('urgent_notices.*', 'urgent_notice_target.store_id')
                    ->get()
                    ->toArray();
        
        $compiledUrgentNotices = [];

        foreach ($urgent_notices as $urgent_notice) {
        $index = array_search($urgent_notice['id'], array_column($compiledUrgentNotices, 'id'));
        if(  $index !== false ){
           array_push($compiledUrgentNotices[$index]->stores, $urgent_notice["store_id"]);
        }
        else{
           
           $urgent_notice["stores"] = [];
           array_push( $urgent_notice["stores"] , $urgent_notice["store_id"]);
           array_push( $compiledUrgentNotices , (object) $urgent_notice);
        }
        }
        return (object)($compiledUrgentNotices);
    }   


    public static function getUrgentNoticeForAdmin()
    {
        $banners = UserBanner::getAllBanners()->pluck('id')->toArray();
        
        //stores in accessible banners
        $storeList = [];
        foreach ($banners as $banner) {
            $storeInfo = StoreInfo::getStoresInfo($banner);
            foreach ($storeInfo as $store) {
                array_push($storeList, $store->store_number);
            }
        }

        $allStoreUrgentNotices = UrgentNotice::join('urgent_notice_banner', 'urgent_notice_banner.urgent_notice_id', '=', 'urgent_notices.id')
                                ->where('all_stores', 1)
                                ->whereIn('urgent_notice_banner.banner_id', $banners)
                                ->select('urgent_notices.*', 'urgent_notice_banner.banner_id')
                                ->get();


        $allStoreUrgentNotices = Utility::groupBannersForAllStoreContent($allStoreUrgentNotices);
        
        $targetedUrgentNotices = UrgentNotice::join('urgent_notice_target', 'urgent_notice_target.urgent_notice_id', '=', 'urgent_notices.id')
                                ->whereIn('urgent_notice_target.store_id', $storeList)
                                
                                ->select(\DB::raw('urgent_notices.*, GROUP_CONCAT(DISTINCT urgent_notice_target.store_id) as stores'))
                                ->groupBy('urgent_notices.id')
                                ->get()
                                ->each(function($urgentNotice){
                                    $urgentNotice->stores = explode(',', $urgentNotice->stores);
                                });

        $storeGroups = CustomStoreGroup::getStoreGroupsForAdmin();
        $urgentNoticeForStoreGroups = UrgentNotice::join('urgent_notice_store_group','urgent_notice_store_group.urgent_notice_id','=','urgent_notices.id')
                                            ->whereIn('urgent_notice_store_group.store_group_id', $storeGroups)
                                            ->select('urgent_notices.*')
                                            ->get()
                                            ->each(function($item){
                                                $storeGroups = UrgentNoticeStoreGroup::where('urgent_notice_id', $item->id)->get()->pluck('store_group_id')->toArray();
                                                $item->storeGroups = $storeGroups;
                                                $item->stores = [];
                                                foreach ($storeGroups as $group) {
                                                    $stores = unserialize(CustomStoreGroup::find($group)->stores);
                                                    $item->stores = array_merge($item->stores,$stores);
                                                }
                                                $item->stores = array_unique( $item->stores);
                                            });
        $targetedUrgentNotices = Utility::mergeTargetedAndStoreGroupContent($targetedUrgentNotices, $urgentNoticeForStoreGroups);

        $urgentNotices = Utility::mergeTargetedAndAllStoreContent($targetedUrgentNotices, $allStoreUrgentNotices);


        foreach ($urgentNotices as $urgentNotice) {
            
            $urgentNotice->prettyDateCreated = Utility::prettifyDate($urgentNotice->created_at);
            $urgentNotice->prettyDateUpdated = Utility::prettifyDate($urgentNotice->updated_at);
        }
                        
                        
        return $urgentNotices;
    }

    public static function getSelectedStoresAndBannersByUrgentNoticeId($urgent_notice_id)
    {
        $targetBanners = UrgentNoticeBanner::where('urgent_notice_id', $urgent_notice_id)->get()->pluck('banner_id')->toArray();
        $targetStores = UrgentNoticeTarget::where('urgent_notice_id', $urgent_notice_id)->get()->pluck('store_id')->toArray();

        $storeGroups = UrgentNoticeStoreGroup::where('urgent_notice_id', $urgent_notice_id)->get()->pluck('store_group_id')->toArray();

        $optGroupSelections = [];
        foreach ($targetBanners as $banner) {
            array_push($optGroupSelections, 'banner'.$banner);
        }
        foreach ($targetStores as $stores) {
            array_push($optGroupSelections, 'store'.$stores);   
        }
        foreach ($storeGroups as $group) {
            array_push($optGroupSelections, 'storegroup'.$group);   
        }


        return( $optGroupSelections );
    }

}
