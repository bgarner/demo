<?php

namespace App\Models\Communication;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use App\Models\Communication\CommunicationPackage;
use App\Models\Communication\CommunicationDocument;
use App\Models\Document\Document;
use App\Models\Document\Package;
use App\Models\Tag\ContentTag;
use App\Models\Communication\CommunicationTarget;
use App\Models\Communication\CommunicationType;
use DB;
use App\Models\Utility\Utility;
use App\Models\Validation\CommunicationValidator;
use App\Models\StoreApi\StoreInfo;
use App\Models\Auth\User\UserBanner;
use App\Models\Auth\User\UserSelectedBanner;
use App\Models\Tools\CustomStoreGroup;
use App\Models\StoreApi\Banner;

class Communication extends Model
{
	protected $table = 'communications';
	protected $fillable = ['subject', 'body', 'sender', 'importance', 'communication_type_id', 'send_at', 'archive_at', 'is_draft', 'all_stores'];


	public static function validateCreateCommunication($request)
	{
		$validateThis =  [

			'subject'               => $request['subject'],
			'start'                 => $request['send_at'],
			'end'                   => $request['archive_at'],
			'communication_type_id' => $request['communication_type_id']

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

		if(isset($request['communication_documents']) && $request['communication_documents']){
		 	$validateThis['documents'] = $request['communication_documents'];
		}

		\Log::info($validateThis);
		$v = new CommunicationValidator();
		return $v->validate($validateThis);

	}

	public static function validateEditCommunication($request)
	{
		$validateThis =  [

			'subject'               => $request['subject'],
			'start'                 => $request['send_at'],
			'end'                   => $request['archive_at'],
			'communication_type_id' => $request['communication_type_id']
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

		if(isset($request['communication_documents']) && $request['communication_documents']){
		 	$validateThis['documents'] = $request['communication_documents'];
		}
		if(isset($request['remove_document']) && $request['remove_document']){
		 	$validateThis['remove_document'] = $request['remove_document'];
		}

		\Log::info($validateThis);
		$v = new CommunicationValidator();
		return $v->validate($validateThis);
	}

	public static function getCommunicationsForAdmin()
	{
		$banner = UserSelectedBanner::getBanner()->id;

        $storeList = [];

        $storeInfo = StoreInfo::getStoresInfo($banner);
        foreach ($storeInfo as $store) {
            array_push($storeList, $store->store_number);
        }

        $allStoreCommunications = Communication::join('communication_banner', 'communication_banner.communication_id', '=', 'communications.id')
                                ->where('all_stores', 1)
                                ->where('communication_banner.banner_id', $banner)
                                ->select('communications.*', 'communication_banner.banner_id')
                                ->get();

        $allStoreCommunications = Utility::groupBannersForAllStoreContent($allStoreCommunications);


        $targetedCommunications = Communication::join('communications_target', 'communications_target.communication_id', '=', 'communications.id')
                                ->whereIn('communications_target.store_id', $storeList)
                                ->select(\DB::raw('communications.*, GROUP_CONCAT(DISTINCT communications_target.store_id) as stores'))
                                ->groupBy('communications.id')
                                ->get()
                                ->each(function($comm){
                                    $comm->stores = explode(',', $comm->stores);
                                });

        $storeGroups = CustomStoreGroup::getStoreGroupsForAdmin();
        $communicationForStoreGroups = Communication::join('communication_store_group', 'communication_store_group.communication_id', '=', 'communications.id')
                                            ->whereIn('communication_store_group.store_group_id', $storeGroups)
                                            ->select('communications.*')
                                            ->get()
                                            ->each(function($item){
                                                $storeGroups = CommunicationStoreGroup::where('communication_id', $item->id)->get()->pluck('store_group_id')->toArray();
                                                $item->storeGroups = $storeGroups;
                                                $item->stores = [];
                                                foreach ($storeGroups as $group) {
                                                    $stores = unserialize(CustomStoreGroup::find($group)->stores);
                                                    $item->stores = array_merge($item->stores,$stores);
                                                }
                                                $item->stores = array_unique( $item->stores);
                                            });

        $targetedCommunications = Utility::mergeTargetedAndStoreGroupContent($targetedCommunications, $communicationForStoreGroups);

        $communications = Utility::mergeTargetedAndAllStoreContent($targetedCommunications, $allStoreCommunications);

        foreach($communications as $c){
			$c->prettySentAtDate = Utility::prettifyDate( $c->send_at );
			$c->prettyArchiveAtDate = Utility::prettifyDate( $c->archive_at );
			$c->label_name = Communication::getCommunicationCategoryName($c->communication_type_id);
            $c->label_colour = Communication::getCommunicationCategoryColour($c->communication_type_id);
		}


        return $communications;
	}

	public static function getCommunicationByStoreNumber($request, $storeNumber)
	{

		$isValidCommunicationType = CommunicationType::isValidCommunicationType($request['type']);
		if ($isValidCommunicationType) {

		    $targetedCommunications = Communication::getActiveCommunicationsByCategory($storeNumber, $request['type']);
		    $targetedCommunications = Communication::processActiveCommunications($targetedCommunications);
		}
		else {
		    $targetedCommunications = Communication::getActiveCommunicationsByStoreNumber($storeNumber);
		    $targetedCommunications = Communication::processActiveCommunications($targetedCommunications);
		}

		if (isset($request['archives']) && !empty($request['archives'])) {

		    if($isValidCommunicationType){
		        $archivedCommunication = Communication::getArchivedCommunicationsByCategory($request['type'], $storeNumber);
		        $archivedCommunication = Communication::processArchivedCommunications($archivedCommunication);
		        foreach ($archivedCommunication as $ac) {
		            $targetedCommunications->add($ac);
		        }
		    }

		    else{

		        $archivedCommunication = Communication::getArchivedCommunicationsByStoreNumber($storeNumber);
		        $archivedCommunication = Communication::processArchivedCommunications($archivedCommunication);
		        foreach ($archivedCommunication as $ac) {
		            $targetedCommunications->add($ac);
		        }
		    }

		}

		return $targetedCommunications;
	}

	public static function getActiveCommunicationsByStoreNumber($storeNumber, $maxToFetch=null)
	{

		$banner_id = StoreInfo::getStoreInfoByStoreId($storeNumber)->banner_id;
		$now = Carbon::now();

		$allStoreComm = Communication::join('communication_banner', 'communication_banner.communication_id', '=', 'communications.id')
									->where('all_stores', '=', 1)
                                    ->where('communication_banner.banner_id', $banner_id)
                                    ->where('communications.send_at', '<=', $now )
                                    ->where('communications.archive_at', '>=', $now )
                                    ->select('communications.*')
                                    ->get();

		$targetedComm = CommunicationTarget::where('store_id', $storeNumber)
						->join('communications', 'communications.id', '=', 'communications_target.communication_id')
						->where('communications.send_at', '<=', $now )
						->where('communications.archive_at', '>=', $now )
						->select('communications.*')
						->get();

		$storeGroups = CustomStoreGroup::getStoreGroupsForStore($storeNumber);

        $storeGroupCommunications = Communication::join('communication_store_group', 'communication_store_group.communication_id', '=', 'communications.id')
        										->whereIn('communication_store_group.store_group_id', $storeGroups)
												->where('communications.send_at', '<=', $now )
												->where('communications.archive_at', '>=', $now )
												->select('communications.*')
						                        ->get();

		$comm = $allStoreComm->merge($targetedComm)
							->merge($storeGroupCommunications)
							->sortByDesc('send_at')
							->take($maxToFetch)
							->values();

		return $comm;

	}

	public static function getArchivedCommunicationsByStoreNumber($storeNumber)
	{
		$now = Carbon::now();

		$banner_id = StoreInfo::getStoreInfoByStoreId($storeNumber)->banner_id;

		$allStoreComm = Communication::join('communication_banner', 'communication_banner.communication_id', '=', 'communications.id')
									->where('all_stores', '=', 1)
                                    ->where('communication_banner.banner_id', $banner_id)
                                    ->where('archive_at', '<=', $now)
									->select('communications.*')
                                    ->orderBy('communications.send_at', 'desc')
                                    ->get();

		$targetedComm = Communication::join('communications_target', 'communications.id' , '=', 'communications_target.communication_id')
						  ->where('store_id', $storeNumber)
						  ->where('archive_at', '<=', $now)
						  ->select('communications.*')
						  ->orderBy('communications.send_at', 'desc')
						  ->get();

		$storeGroups = CustomStoreGroup::getStoreGroupsForStore($storeNumber);

        $storeGroupCommunications = Communication::join('communication_store_group', 'communication_store_group.communication_id', '=', 'communications.id')
        										->whereIn('communication_store_group.store_group_id', $storeGroups)
												->where('archive_at', '<=', $now)
												->select('communications.*')
						                        ->get();

		$comm = $allStoreComm->merge($targetedComm)
							->merge($storeGroupCommunications)
							->sortByDesc('send_at');

		return $comm;
	}

	public static function getActiveCommunicationsByCategory($storeNumber, $type_id)
    {

       	$communications = Communication::getActiveCommunicationsByStoreNumber($storeNumber);
        $communications = $communications->filter(function ($item) use($type_id) {

							    if($item["communication_type_id"] == $type_id){
							    	return $item;
							    }
							})->values();
        return $communications;
    }

	public static function getArchivedCommunicationsByCategory($category, $storeNumber)
	{

		$communications = Communication::getArchivedCommunicationsByStoreNumber($storeNumber);
		$communications = $communications->filter(function ($item) use($category) {

							    if($item["communication_type_id"] == $category){
							    	return $item;
							    }
							})->values();
        return $communications;
	}

	public static function getCommunicationById($id)
	{
		$communication             = Communication::find($id);
		$communication->since      = Utility::getTimePastSinceDate($communication->send_at);
		$communication->prettyDate = Utility::prettifyDate($communication->send_at);

		return $communication;

	}

	public static function getNextCommunication($communications, $communication)
	{
		$nextCommunicationId = null;
        $now = Carbon::now();

        if($now <= $communication->archive_at){

            $currentCommunicationIndex = $communications->where('id', $communication->id)->keys()->toArray()[0];
            $next = $currentCommunicationIndex + 1;


            if($next > count($communications)-1){
                $nextCommunicationId = null;
            }
            else{
                $nextCommunicationId = $communications->get($next)->id;
            }

        }

        return $nextCommunicationId;
	}

	public static function getPreviousCommunication($communications, $communication)
	{
        $previousCommunicationId = null;
        $now = Carbon::now();
        if($now <= $communication->archive_at){

            $currentCommunicationIndex = $communications->where('id', $communication->id)->keys()->toArray()[0];
            $previous = $currentCommunicationIndex - 1;

            if($previous < 0){
                $previousCommunicationId = null;
            }
            else{
                $previousCommunicationId = $communications->get($previous)->id;
            }
        }
        return $previousCommunicationId;
	}

	public static function storeCommunication($request)
	{
		\Log::info($request->all());
		$validate = Communication::validateCreateCommunication($request);
		\Log::info($validate);
		if($validate['validation_result'] == 'false') {
			\Log::info($validate);
			return json_encode($validate);
		}
		$is_draft = 0;
		if ($request["send_at"]>Carbon::now()) {
			$is_draft = 1;
		}
		$communication = Communication::create([
			'subject'               => $request["subject"],
			'communication_type_id' => $request["communication_type_id"],
			'body'                  => $request["body"],
			'sender'                => "",
			'importance'            => 1,
			'is_draft'              => $is_draft,
			'send_at'               => $request["send_at"],
			'archive_at'            => $request["archive_at"],
			// 'banner_id'             => $request["banner_id"]
		]);

		CommunicationTarget::updateTargetStores($communication->id, $request);
		CommunicationDocument::updateCommunicationDocuments($communication->id, $request);
		CommunicationPackage::updateCommunicationPackages($communication->id, $request);
		ContentTag::updateTags( 'communication', $communication->id, $request->tags);
		return $communication;
	}

	public static function updateCommunication($id, $request)
	{
		\Log::info($request->all());
		$validate = Communication::validateEditCommunication($request);

		if($validate['validation_result'] == 'false') {
			\Log::info($validate);
			return json_encode($validate);
		}


		$communication = Communication::find($id);

		$communication["subject"] = $request["subject"];
		$communication["body"]    = $request["body"];
		if (isset($request['communication_type_id'])) {
			$communication["communication_type_id"] = $request["communication_type_id"];
		}

		$communication["sender"]     = $request["sender"];
		$communication["importance"] = $request["importance"];
		$communication["send_at"]    = $request["send_at"];
		$communication["archive_at"] = $request["archive_at"];
		if ($request["send_at"] > Carbon::now()) {
		$communication["is_draft"]   = 1;
		}
		else {
		$communication["is_draft"]   = 0;
		}

		$communication->save();

		CommunicationTarget::updateTargetStores($communication->id, $request);
		CommunicationDocument::updateCommunicationDocuments($communication->id, $request);
		CommunicationPackage::updateCommunicationPackages($communication->id, $request);
		ContentTag::updateTags( 'communication', $id, $request->tags);

		return $communication;

	}

	public static function updateTags($id, $tags)
	{
		if (isset($tags)) {
			ContentTag::where('content_type', 'communication')->where('content_id', $id)->delete();
			foreach ($tags as $tag) {
				ContentTag::create([
						'content_type' => 'communication',
						'content_id'      => $id,
						'tag_id'          => $tag
				]);
			}
		}

		return;
	}

	public static function deleteCommunication($id)
	{
		Communication::find($id)->delete();
		CommunicationPackage::where('communication_id', $id)->delete();
		CommunicationDocument::where('communication_id', $id)->delete();
		CommunicationTarget::where('communication_id', $id)->delete();
		ContentTag::where('content_id', $id)->where('content_type', 'communication')->delete();
		return;
	}

	public static function getCommunicationCountByStoreNumber($request, $storeNumber)
	{
		if(isset($request['archives']) && $request['archives'] !== ""){
			return Communication::getAllCommunicationCount($storeNumber);
		}

		else{
			return Communication::getActiveCommunicationCount($storeNumber);
		}

	}

	public static function getActiveCommunicationCount($storeNumber)
	{
		$comm = Self::getActiveCommunicationsByStoreNumber($storeNumber);
		return count($comm);
	}

	public static function getAllCommunicationCount($storeNumber)
	{
		$banner_id = StoreInfo::getStoreInfoByStoreId($storeNumber)->banner_id;

        $allStoreCommunicationCount = Communication::join('communication_banner', 'communication_banner.communication_id', '=', 'communications.id')
									->where('all_stores', '=', 1)
                                    ->where('communication_banner.banner_id', $banner_id)
        							->count();

		$targetedCommunicationCount = Communication::join('communications_target', 'communications_target.communication_id', '=', 'communications.id')
						->where('store_id', $storeNumber)
						->count();

		$storeGroups = CustomStoreGroup::getStoreGroupsForStore($storeNumber);

        $storeGroupCommunicationCount = Communication::join('communication_store_group', 'communication_store_group.communication_id', '=', 'communications.id')
        										->whereIn('communication_store_group.store_group_id', $storeGroups)
												->count();

		$communicationCount = $allStoreCommunicationCount + $targetedCommunicationCount + $storeGroupCommunicationCount;

		return $communicationCount;
	}

	public static function getActiveCommunicationCountByCategory($storeNumber, $categoryId)
	{

		$comm = Self::getActiveCommunicationsByCategory($storeNumber, $categoryId);
		return count($comm);
	}

	public static function getAllCommunicationCountByCategory($storeNumber, $categoryId)
	{
		$banner_id = StoreInfo::getStoreInfoByStoreId($storeNumber)->banner_id;

		$allStoreCommunicationCount  = Communication::join('communication_banner', 'communication_banner.communication_id', '=', 'communications.id')
													->where('all_stores', '=', 1)
                                    				->where('communication_banner.banner_id', $banner_id)
													->where('communications.communication_type_id', $categoryId)
                                                    ->count();

		$targetedCommunicationCount = DB::table('communications_target')
					->where('store_id', $storeNumber)
					->join('communications', 'communications.id', '=', 'communications_target.communication_id')
					->where('communications.communication_type_id', $categoryId)
					->count();

		$storeGroups = CustomStoreGroup::getStoreGroupsForStore($storeNumber);

        $storeGroupCommunicationCount = Communication::join('communication_store_group', 'communication_store_group.communication_id', '=', 'communications.id')
        										->whereIn('communication_store_group.store_group_id', $storeGroups)
												->where('communications.communication_type_id', $categoryId)
												->count();

		$count = $allStoreCommunicationCount + $targetedCommunicationCount + $storeGroupCommunicationCount;
		return $count;
	}

	public static function getActiveCommunicationsForStoreList($storeNumbersArray, $banners, $storeGroups)
	{
		$now = Carbon::now()->toDatetimeString();
		$targetedComm = Communication::getActiveTargetedCommunicationsForStoreList($storeNumbersArray);

		$allStoreComm = Communication::join('communication_banner', 'communication_banner.communication_id', '=', 'communications.id')
									->where('all_stores', '=', 1)
                                    ->whereIn('communication_banner.banner_id', $banners)
                                    ->where('communications.send_at', '<=', $now )
                                    ->where('communications.archive_at', '>=', $now )
                                    ->select('communications.*')
                                    ->get();

        $storeGroupCommunications = Communication::join('communication_store_group', 'communication_store_group.communication_id', '=', 'communications.id')
        										->whereIn('communication_store_group.store_group_id', $storeGroups)
												->where('communications.send_at', '<=', $now )
												->where('communications.archive_at', '>=', $now )
												->select(\DB::raw('communications.*, GROUP_CONCAT(DISTINCT communication_store_group.store_group_id) as store_groups'))
												->groupBy('communications.id')
						                        ->get()
						                        ->each(function($comm)use ($storeNumbersArray){
	                                    			$store_groups = explode(',', $comm->store_groups);

	                                                $comm->store_groups = $store_groups;
	                                                $group_stores = [];
	                                                foreach ($store_groups as $group) {
	                                                    $stores = unserialize(CustomStoreGroup::find($group)->stores);
	                                                    $group_stores = array_merge($group_stores,$stores);
	                                                }
	                                                $group_stores = array_unique( $group_stores);

	                                                $comm->stores = array_intersect($storeNumbersArray, $group_stores);
	                                			});


		$targetedComm = Utility::mergeTargetedAndStoreGroupContent($targetedComm, $storeGroupCommunications);
         
        $communications = Utility::mergeTargetedAndAllStoreContent($targetedComm, $allStoreComm);

        return($communications);
	}

	public static function getActiveTargetedCommunicationsForStoreList($storeNumbersArray)
	{
		$now = Carbon::now()->toDatetimeString();
		
		$communications = Communication::join('communications_target', 'communications_target.communication_id' ,  '=', 'communications.id')
								   ->whereIn('communications_target.store_id', $storeNumbersArray)
								   ->where('communications.send_at' , '<=', $now)
								   ->where('communications.archive_at', '>=', $now)
								   ->whereNull('communications.deleted_at')
								   ->whereNull('communications_target.deleted_at')
								   ->select(\DB::raw('communications.*, GROUP_CONCAT(DISTINCT communications_target.store_id) as stores'))
	                                ->groupBy('communications.id')
	                                ->get()
	                                ->each(function($comm){
	                                    $comm->stores = explode(',', $comm->stores);
	                                });
	 	
		return $communications;
	}

	public static function getCommunicationCategoryName($id)
	{
		if(isset($id) && !empty($id)){

			if( CommunicationType::find($id) ){
				return CommunicationType::where('id', $id)->first()->communication_type;
			}
		}

	}

	public static function getCommunicationCategoryColour($id)
	{
		return CommunicationType::where('id', $id)->first()->colour;
	}


	public static function hasAttachments($id)
	{
		$hasAttachments = CommunicationDocument::where('communication_id', $id)->get();
		$hasPackages = CommunicationPackage::where('communication_id', $id)->get();

		if( count($hasAttachments)>0 || count($hasPackages) >0 ){
			return true;
		}

		return false;
	}

	public static function getSelectedStoresAndBannersByCommunicationId($communication_id)
	{
		$targetBanners = CommunicationBanner::where('communication_id', $communication_id)->get()->pluck('banner_id')->toArray();
        $targetStores = CommunicationTarget::where('communication_id', $communication_id)->get()->pluck('store_id')->toArray();
        $storeGroups = CommunicationStoreGroup::where('communication_id', $communication_id)->get()->pluck('store_group_id')->toArray();

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

	public static function processActiveCommunications($communications)
	{
		return $communications->each(function($c){

            $c->prettyDate = Utility::prettifyDate($c->send_at);
            $c->since = Utility::getTimePastSinceDate($c->send_at);
            $c->trunc = Utility::truncateHtml(strip_tags($c->body));
            $c->label_name = Communication::getCommunicationCategoryName($c->communication_type_id);
            $c->label_colour = Communication::getCommunicationCategoryColour($c->communication_type_id);
            $c->has_attachments = Communication::hasAttachments($c->id);

        });
	}

	public static function processArchivedCommunications($communications)
	{
		return $communications->each(function($c){

					$c->archived        = true;
					$c->since           = Utility::getTimePastSinceDate($c->send_at);
					$c->prettyDate      = Utility::prettifyDate($c->send_at);
					$preview_string     = strip_tags($c->body);
					$c->trunc           = Utility::truncateHtml($preview_string);
					$c->label_name      = Communication::getCommunicationCategoryName($c->communication_type_id);
					$c->label_colour    = Communication::getCommunicationCategoryColour($c->communication_type_id);
					$c->has_attachments = Communication::hasAttachments($c->id);

				});
	}



}
