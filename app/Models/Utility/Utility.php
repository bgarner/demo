<?php

namespace App\Models\Utility;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use App\Models\Auth\User\UserBanner;
use App\Models\Auth\User\UserSelectedBanner;
use App\Models\StoreApi\StoreInfo;
use App\Models\Tools\CustomStoreGroup;
use App\Models\StoreApi\Store;
use App\Models\StoreApi\DistrictStore;
use App\Models\StoreApi\RegionDistrict;
use App\Models\Auth\Resource\ResourceTypes;
use App\Models\Auth\Resource\Resource;
use App\Models\Auth\User\UserResource;

class Utility extends Model
{

	public static function getIcon($extension)
	{
		$icon = "";
		switch($extension){
			case "png":
			case "jpg":
			case "gif":
			case "bmp":
				$icon = "<i class='fa fa-file-image-o'></i>";
				break;

			case "pdf":
			case "PDF":
				$icon = "<i class='fa fa-file-pdf-o'></i>";
				break;

			case "xls":
			case "xlsx":
			case "xlsm":
				$icon = "<i class='fa fa-file-excel-o'></i>";
				break;

			case "mp4":
			case "avi":
			case "mov":
				$icon = "<i class='fa fa-film'></i>";
				break;

			case "doc":
			case "docx":
				$icon = "<i class='fa fa-file-word-o'></i>";
				break;

			case "mp3":
			case "wav":
				$icon = "<i class='fa fa-file-audio-o'></i>";
				break;

			case "ppt":
			case "pptx":
				$icon = "<i class='fa fa-file-powerpoint-o'></i>";
				break;

			case "zip":
				$icon = "<i class='fa fa-file-archive-o'></i>";
				break;

			case "html":
			case "css":
			case "js":
				$icon = "<i class='fa fa-file-code-o'></i>";
				break;

			default:
				$icon = "<i class='fa fa-file-o'></i>";
				break;
		}
		return $icon;
	}

	public static function getModalLink($file, $anchortext, $extension, $id, $withIcon=null, $justAnchor=null)
	{
		if($withIcon){
			$icon = Utility::getIcon($extension). " ";
		} else {
			$icon = "";
		}

		switch($extension){
			case "png":
			case "jpg":
			case "gif":
			case "bmp":
				$class = 'launchImageViewer';
				$modalTarget = '#imageviewmodal';
				break;

			case "pdf":
			case "PDF":
				$class = 'launchPDFViewer';
				$modalTarget = '#fileviewmodal';
				break;

			case "xls":
			case "xlsx":
			case "xlsm":
				$class = 'download';
				$modalTarget = 'ExcelDownload';
				break;

			case "mp4":
			case "avi":
			case "mov":
			case "webm":
				$class = 'launchVideoViewer';
				$modalTarget = '#videomodal';
				break;

			case "doc":
			case "docx":
				$class = 'download';
				$modalTarget = '#';
				break;

			case "mp3":
			case "wav":
				$class = 'newwindow';
				$modalTarget = '#';
				break;

			case "ppt":
			case "pptx":
				$class = 'download';
				$modalTarget = '#';
				break;

			case "zip":
				$class = 'download';
				$modalTarget = '#';
				break;

			case "html":
				$class = 'newwindow';
				$modalTarget = '#';
				break;

			case "css":
			case "js":
			default:
				$class = 'nolink';
				$modalTarget = '#';
				break;
		}

		switch($class){

			case "launchImageViewer":
				$link = '<a href="#">'.$icon.$anchortext.'</a>';
				$anchorOnly = "<a href=''>";
				break;

			case "launchPDFViewer":
				$link = '<a href="#" class="launchPDFViewer trackclick" data-res-id="'.$id.'" data-toggle="modal" data-file="/viewer/?file=/files/'.$file.'" data-target="#fileviewmodal">'.$icon.$anchortext.'</a>';
				$anchorOnly = '<a href="#" class="launchPDFViewer trackclick" data-res-id="'.$id.'" data-toggle="modal" data-file="/viewer/?file=/files/'.$file.'" data-target="#fileviewmodal">';
				// $link = '<a href="#" class="launchPDFViewer trackclick" data-res-id="'.$id.'" data-toggle="modal" data-file="/files/'.$file.'" data-target="#fileviewmodal">'.$icon.$anchortext.'</a>';
				// $anchorOnly = '<a href="#" class="launchPDFViewer trackclick" data-res-id="'.$id.'" data-toggle="modal" data-file="/viewer/?file=/files/'.$file.'" data-target="#fileviewmodal">';
				break;

			case "launchVideoViewer":
				$link = '<a href="#" class="launchVideoViewer" data-res-id="'.$id.'" data-file="'.$file.'" data-target="#videomodal">'.$icon.$anchortext.'</a>';
				$anchorOnly = '<a href="#" class="launchVideoViewer" data-res-id="'.$id.'" data-file="'.$file.'" data-target="#videomodal">';
				break;

			case "download":
				$link = '<a href="/files/'.$file.'" class="trackclick" data-res-id="'.$id.'" data-file="'.$file.'" data-target="#">'.$icon.$anchortext.'</a>';
				$anchorOnly = '<a href="/files/'.$file.'" class="trackclick" data-res-id="'.$id.'" data-file="'.$file.'" data-target="#">';
				break;

			case "newwindow":
				$link = '<a href="/files/'.$file.'" class="trackclick" target="_blank">'.$icon.$anchortext.'</a>';
				$anchorOnly = '<a href="/files/'.$file.'" class="trackclick" target="_blank">';
				break;

			case "nolink":
				$link = '<a href="#">'.$icon.$anchortext.'</a>';
				$anchorOnly = '<a href="#">';
				break;

			default:
				$link = "";
				break;
		}

		if($justAnchor){
			return $anchorOnly;
		}

		return $link;
	}

	public static function getAlertIcon()
	{
		return "<i class='fa fa-bell-o'></i>";
	}

	public static function prettifyDate($date)
	{
		if($date == '0000-00-00 00:00:00' || $date == NULL) {
			return "";
		}
		return Carbon::createFromFormat('Y-m-d H:i:s', $date)->format('D, M d, Y');
	}

	public static function prettifyDateWithTime($date)
	{
		if($date == '0000-00-00 00:00:00' || $date == NULL) {
			return "";
		}
		return Carbon::createFromFormat('Y-m-d H:i:s', $date)->format('D, M d, Y h:i a');;
	}

	public static function getTimePastSinceDate($date)
	{
		if($date == '0000-00-00 00:00:00' || $date == NULL) {
			return "";
		}
		$date = Carbon::createFromFormat('Y-m-d H:i:s', $date);
		$since = Carbon::now()->diffForHumans($date, true);
		return $since;
	}

	public static function getMonthName($monthNumber)
    {
        return date("F", mktime(0, 0, 0, $monthNumber, 1));
	}
	
	public static function getDayName($dayNumber)
	{
		return date("l", mktime(0, 0, 0, 0, $dayNumber));
	}

	public static function truncateHtml($text, $length = 100, $ending = '...', $exact = false, $considerHtml = true)
	{
		if ($considerHtml) {
			// if the plain text is shorter than the maximum length, return the whole text
			if (strlen(preg_replace('/<.*?>/', '', $text)) <= $length) {
				return $text;
			}
			// splits all html-tags to scanable lines
			preg_match_all('/(<.+?>)?([^<>]*)/s', $text, $lines, PREG_SET_ORDER);
			$total_length = strlen($ending);
			$open_tags = array();
			$truncate = '';
			foreach ($lines as $line_matchings) {
			   // if there is any html-tag in this line, handle it and add it (uncounted) to the output
			   	if (!empty($line_matchings[1])) {
				  	// if it's an "empty element" with or without xhtml-conform closing slash
					if (preg_match('/^<(\s*.+?\/\s*|\s*(img|br|input|hr|area|base|basefont|col|frame|isindex|link|meta|param)(\s.+?)?)>$/is', $line_matchings[1])) {
					// do nothing
				  	// if tag is a closing tag
				  	}
				  	else if (preg_match('/^<\s*\/([^\s]+?)\s*>$/s', $line_matchings[1], $tag_matchings)) {
					 // delete tag from $open_tags list
						$pos = array_search($tag_matchings[1], $open_tags);
					 	if ($pos !== false) {
					 	unset($open_tags[$pos]);
					}
				  	// if tag is an opening tag
				  	}
				  	else if (preg_match('/^<\s*([^\s>!]+).*?>$/s', $line_matchings[1], $tag_matchings)) {
					 	// add tag to the beginning of $open_tags list
					 	array_unshift($open_tags, strtolower($tag_matchings[1]));
				  	}
				  	// add html-tag to $truncate'd text
				  	$truncate .= $line_matchings[1];
			   	}
			   	// calculate the length of the plain text part of the line; handle entities as one character
			   	$content_length = strlen(preg_replace('/&[0-9a-z]{2,8};|&#[0-9]{1,7};|[0-9a-f]{1,6};/i', ' ', $line_matchings[2]));
			   	if ($total_length+$content_length> $length) {
				  	// the number of characters which are left
				  	$left = $length - $total_length;
				  	$entities_length = 0;
				  	// search for html entities
				  	if (preg_match_all('/&[0-9a-z]{2,8};|&#[0-9]{1,7};|[0-9a-f]{1,6};/i', $line_matchings[2], $entities, PREG_OFFSET_CAPTURE)) {
					 // calculate the real length of all entities in the legal range
						foreach ($entities[0] as $entity) {
							if ($entity[1]+1-$entities_length <= $left) {
						   		$left--;
						   		$entities_length += strlen($entity[0]);
							} else {
						   	// no more characters left
						   		break;
							}
					 	}
				  	}
				  	$truncate .= substr($line_matchings[2], 0, $left+$entities_length);
				  	// maximum lenght is reached, so get off the loop
				  	break;
			   	}
			   	else {
				  	$truncate .= $line_matchings[2];
				  	$total_length += $content_length;
			   	}
			   	// if the maximum length is reached, get off the loop
			   	if($total_length>= $length) {
				  	break;
			   	}
			}
		}
		else {
			if (strlen($text) <= $length) {
		   		return $text;
			} else {
		   		$truncate = substr($text, 0, $length - strlen($ending));
			}
		}
		// if the words shouldn't be cut in the middle...
		if (!$exact) {
			// ...search the last occurance of a space...
			$spacepos = strrpos($truncate, ' ');
			if (isset($spacepos)) {
		   		// ...and cut the text in this position
		   		$truncate = substr($truncate, 0, $spacepos);
			}
		}
		// add the defined ending to the text
		$truncate .= $ending;
		if($considerHtml) {
			// close all unclosed html-tags
			foreach ($open_tags as $tag) {
		   		$truncate .= '</' . $tag . '>';
			}
		}
		return $truncate;
	}


	public static function getStoreAndBannerSelectDropdownOptions($allAccessibleBanners = null)
	{
		
		if(isset($allAccessibleBanners)){
			$banners = Self::getBannerListByAdminId();

        	$storeList = Self::getStoreListByAdminId();

        	$storeGroups = Self::getStoreGroupsByAdminId();
		}
		else{
			$banners = Self::getBannerInListForm();

        	$storeList = Self::getStoreListByBannerIdForStoreSelector();

        	$storeGroups = Self::getStoreGroupsByBannerId();	
		}
		

        $optGroupOptions = [];
        $optGroupBannerOptions = [];
        $optGroupBannerOptions['optgroup-label'] = 'Banners';
        $optGroupBannerOptions['options'] = $banners;

        array_push($optGroupOptions, $optGroupBannerOptions);


        $optGroupStoreOptions = [];
        $optGroupStoreOptions['optgroup-label'] = 'Stores';
        $optGroupStoreOptions['options'] = $storeList;
        array_push($optGroupOptions, $optGroupStoreOptions);

        $optGroupStoreGroupOptions = [];
        $optGroupStoreGroupOptions['optgroup-label'] = 'Store Groups';
        $optGroupStoreGroupOptions['options'] = $storeGroups;
        array_push($optGroupOptions, $optGroupStoreGroupOptions);

        return $optGroupOptions;
	}

	public static function getStoreListByBannerId()
    {
        $banner = UserSelectedBanner::getBanner();
        $storeList = [];

        // foreach ($banners as $banner) {

        $storeInfo = StoreInfo::getStoresInfo($banner->id);
        foreach ($storeInfo as $store) {
            $storeList[$store->store_number] = $store->store_id . " " . $store->name . " (" . $banner->name .")" ;
        }

        // }

        return $storeList;
    }

    public static function getBannerInListForm()
    {
    	$banner = UserSelectedBanner::getBanner();
    	
    	$bannerList = [];
		
		$value = [];
		$value['option-label'] = $banner->name;
		$value['data-attributes'] = [
									'allStores'   => 1 ,
									'optionType'  => 'banner',
									'resourceId'  => $banner->id
								];
		$bannerList['banner'.$banner->id] = $value;
		
		return $bannerList;
    }
    
    public static function getBannerListByAdminId()
    {
    	$banners = UserBanner::getAllBanners();
    	
    	$bannerList = [];
		foreach ($banners as $banner) {
			$value = [];
			$value['option-label'] = $banner->name;
			$value['data-attributes'] = [
										'allStores'   => 1 ,
										'optionType'  => 'banner',
										'resourceId'  => $banner->id
									];
			$bannerList['banner'.$banner->id] = $value;
		}
		
		return $bannerList;
    }

    public static function getStoreListByBannerIdForStoreSelector()
    {
        $banner = UserSelectedBanner::getBanner();
        $storeList = [];

        $storeInfo = StoreInfo::getStoresInfo($banner->id);
        foreach ($storeInfo as $store) {
            $storeList['store'.$store->store_number] = [
            		'option-label' => $store->store_id . " " . $store->name . " (" . $banner->name .")" ,
            		'data-attributes' => [
            				'parentBanner' => $store->banner_id,
            				'optionType'   => 'store',
            				'resourceId'   => $store->store_number
            			]
            	];
        }

        return $storeList;
    }

    public static function getStoreListByAdminId()
    {
        $banners = UserBanner::getAllBanners();
        $storeList = [];

        foreach ($banners as $banner) {

            $storeInfo = StoreInfo::getStoresInfo($banner->id);
            foreach ($storeInfo as $store) {
                $storeList['store'.$store->store_number] = [
                		'option-label' => $store->store_id . " " . $store->name . " (" . $banner->name .")" ,
                		'data-attributes' => [
                				'parentBanner' => $store->banner_id,
                				'optionType'   => 'store',
                				'resourceId'   => $store->store_number
                			]
                	];
            }

        }

        return $storeList;
    }

    public static function getStoreGroupsByBannerId()
    {
    	
    	$banner = UserSelectedBanner::getBanner();
    	$storeGroups = CustomStoreGroup::getGroupsByBanner($banner->id);
    	$groupList = [];
    	foreach ($storeGroups as $group) {
    		
            $groupList['storegroup'.$group->id] = [
        		'option-label' => $group->group_name. " (" . implode(', ', $group->stores) . ")",
        		'data-attributes' => [
        				'optionType'  => 'storegroup',
        				'resourceId'  => $group->id

        			]
            	];
        }
        return $groupList;
    }

    public static function getStoreGroupsByAdminId()
    {
    	$banners = UserBanner::getAllBanners()->pluck('id')->toArray();
    	$storeGroups = CustomStoreGroup::getGroupsForMultipleBanners($banners);
    	$groupList = [];
    	foreach ($storeGroups as $group) {
    		
            $groupList['storegroup'.$group->id] = [
        		'option-label' => $group->group_name. " (" . implode(', ', $group->stores) . ")",
        		'data-attributes' => [
        				'optionType'  => 'storegroup',
        				'resourceId'  => $group->id
        			]
            	];
        }
        return $groupList;
    }

    public static function addHeadOffice($contentId, $table, $pivotColumn)
    {
    	$headOffice = '0940';
    	$banner_id = UserSelectedBanner::getBanner()->id;

		if($banner_id == 1){
        	$headOffice = '0940';
	    }else if($banner_id == 2){
	        $headOffice = 'A0940';
	    }

	    \DB::table($table)->insert([
	        $pivotColumn => $contentId,
	        'store_id'   => $headOffice
	    ]);

	}
	
	public static function removeHeadOffice($stores)
	{
		$headOfficeStores = ['0940', 'A0940'];
		foreach($headOfficeStores as $ho){

			$keys = array_keys($stores, $ho);

			if( count($keys) > 0 ){
				foreach($keys as $k){
					unset($stores[$k]);
				}	
			}
		}
		return $stores;
	}

    public static function groupBannersForAllStoreContent($allStoreContent)
    {
        $allStoreContent = $allStoreContent->toArray();
        $compiledContent = [];
        foreach ($allStoreContent as $content) {
            $index = array_search($content['id'], array_column($compiledContent, 'id'));
            if(  $index !== false ){
               array_push($compiledContent[$index]->banners, $content["banner_id"]);
            }
            else{
               
               $content["banners"] = [];
               array_push( $content["banners"] , $content["banner_id"]);
               array_push( $compiledContent , (object) $content);
            }

        }
        
        return collect($compiledContent);
    }

    public static function mergeTargetedAndStoreGroupContent($targetedContent, $storeGroupContent)
    {
        $targetedContentArray = $targetedContent->toArray();
        $targetedContentIds = array_column($targetedContentArray, 'id');
        foreach ($storeGroupContent as $content) {

            if(in_array($content->id, $targetedContentIds)){
                $targetedContentStores = $targetedContent->where('id', $content->id)->first()->stores;
                $mergedStores = array_merge( $targetedContentStores, $content->stores);
                $targetedContent->where('id', $content->id)->first()->stores = $mergedStores;
            }
            else{

                $targetedContent = $targetedContent->push((object)$content);                
            }
        }
        
        return $targetedContent;

    }

    public static function mergeTargetedAndAllStoreContent($targetedContent, $allStoreContent)
    {        
        
        // \Log::info("before merge count : " . count($allStoreContent));
        // foreach($targetedContent as $content)
        // {
        //     $id = $content->id;

        //     if($allStoreContent->contains('id', $id)){
        //         $contentIndex = $allStoreContent->where('id', $id)->keys()->toArray()[0];
        //         $allStoreContent[$contentIndex]->stores = $content->stores;
                
        //     }
        //     else{
        //         $allStoreContent = $allStoreContent->push($content);
        //     }
        // }
        // \Log::info("after merge count : " . count($allStoreContent));


        foreach ($allStoreContent as $content) {
        	$id = $content->id;
        	if($targetedContent->contains('id', $id)){
                $contentIndex = $targetedContent->where('id', $id)->keys()->toArray()[0];
                $targetedContent[$contentIndex]->banner_id = $content->banner_id;
                
            }
            else{
                $targetedContent = $targetedContent->push($content);
            }
        }

        return $targetedContent;
    }

    public static function getUniqueBannersForTarget($request)
    {
    	$targetStores = collect();
        $banners = collect();
        
        //merge stores for store groups
        if(isset($request->store_groups)){
            $storeGroups = $request->store_groups;
                
            foreach ($storeGroups as $group) {
                $groupDetails = CustomStoreGroup::find($group);
                $stores = unserialize($groupDetails->stores);
                $targetStores = $targetStores->merge($stores);
            }
        }

        if(isset($request->target_stores)){
            $targetStores = $targetStores->merge($request->target_stores);
        }

        //find unique banners for stores
        if(count($targetStores)>0){
            $allStores = Store::getAllStores()->pluck('banner_id','store_number')->toArray();
            foreach ($targetStores as $store) {
                if(array_key_exists($store, $allStores)){
                    $banners->push($allStores[$store]);
                }
            }    
        }
        
        $banners = $banners->unique();


        //merge unique banners from previous step with target_banners
        if(isset($request->target_banners)){

            $banners = $banners->merge($request->target_banners)->sort();
            
        }
        $banners = array_values($banners->unique()->toArray());

        return $banners;
    }


    public static function formatUsersList($users)
    {
    	$userlist = [];
    	foreach ($users as $user) {
    		$userlist[$user->id] = $user->firstname . " " . $user->lastname . " ( " . $user->fglposition . " )"; 
    	}

    	return $userlist;
    }

    public static function getAllProvinces()
    {
    	return ['AB'=>'AB', 'BC'=>'BC', 'MB'=>'MB', 'NB'=>'NB', 'NL'=>'NL', 'NS'=>'NS', 'ON'=>'ON', 'PE'=>'PE', 'QC'=>'QC', 'SK'=>'SK'];
    }

    public static function makeStoreNumber($store_id, $banner_id, $is_combo_store = null)
    {	
    	$store_number = str_pad($store_id, 4, '0', STR_PAD_LEFT);
    	if(isset($is_combo_store) && $banner_id == 2 ){
    		$store_number = 'A' . $store_number;
    	}
    	return $store_number;
    }

    public static function getDMForStore($storeNumber)
    {
    	$district_id = DistrictStore::where('store_id', $storeNumber)->first()->district_id;
        $resource_type_id = ResourceTypes::where('resource_name', 'district')->first()->id;
        $resource = Resource::getResourceByResourceTypeIdandResourceId($resource_type_id, $district_id);
        $user = UserResource::getUserByResourceId($resource->id);
        return $user;
    }

    public static function getAVPForStore($storeNumber)
    {
    	$district_id = DistrictStore::where('store_id', $storeNumber)->first()->district_id;
    	$region_id = RegionDistrict::where('district_id', $district_id)->first()->region_id;
        $resource_type_id = ResourceTypes::where('resource_name', 'region')->first()->id;
        $resource = Resource::getResourceByResourceTypeIdandResourceId($resource_type_id, $region_id);
        $user = UserResource::getUserByResourceId($resource->id);
        return $user;
    }

}
