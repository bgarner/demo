<?php

namespace App\Models\Tools;

use Illuminate\Database\Eloquent\Model;
use App\Models\Validation\CustomStoreGroupValidator;
use App\Models\Auth\User\UserBanner;
use App\Models\Auth\User\UserSelectedBanner;
use App\Models\StoreApi\Store;
use App\Models\StoreApi\StoreInfo;
use Carbon\Carbon;

class CustomStoreGroup extends Model
{
 	protected $table = 'custom_store_group';

 	protected $fillable = ['group_name', 'stores', 'banner_id', 'archived_at'];

 	public static function validateCustomStoreGroup($request)
	{
		$validateThis =  [

			'group_name' => $request['group_name'],
			'target_stores'     => $request['stores']

		];

		\Log::info($validateThis);
		$v = new CustomStoreGroupValidator();
		return $v->validate($validateThis);

	}

	public static function validateEditCustomStoreGroup($request, $id)
	{
		$validateThis =  [
			'target_stores'     => $request['stores']
		];

		$group_name = strtolower(CustomStoreGroup::find($id)->group_name);
		$new_group_name = strtolower($request['group_name']);

		if($group_name !== $new_group_name){
			$validateThis['group_name'] = $request['group_name'];
		}
		\Log::info($validateThis);
		$v = new CustomStoreGroupValidator();
		return $v->validate($validateThis);

	}


 	public static function getAllGroups()
 	{
 		return CustomStoreGroup::whereNull('archived_at')->get()->each(function($group){
 			$group->stores = unserialize($group->stores);
 		});
 	}

 	public static function getGroupsByBanner($banner_id)
 	{	
		 return CustomStoreGroup::where('banner_id', $banner_id)
		 								->whereNull('archived_at')
                                        ->get()
                                        ->each(function($group){
                            $group->stores = unserialize($group->stores);
                        });
 	}

 	public static function getGroupsForMultipleBanners($banners)
 	{
 		return CustomStoreGroup::whereIn('banner_id', $banners)
                                        ->get()
                                        ->each(function($group){
                            $group->stores = unserialize($group->stores);
                        });
 	}

 	public static function saveStoreGroup($request)
 	{

		$validate = Self::validateCustomStoreGroup($request);
		$banner_id = UserSelectedBanner::getBanner()->id;
		\Log::info($validate);
		if($validate['validation_result'] == 'false') {
			\Log::info($validate);
			return json_encode($validate);
		}
		
		$storeGroup = Self::create([
			'group_name' => $request["group_name"],
			'stores'     => serialize($request["stores"]),
			'banner_id'  => $banner_id
		]);

		return $storeGroup;
 	}

 	public static function editStoreGroup($request, $id)
 	{

		\Log::info($request->all());
		$validate = Self::validateEditCustomStoreGroup($request, $id);
		\Log::info($validate);
		if($validate['validation_result'] == 'false') {
			\Log::info($validate);
			return json_encode($validate);
		}
		
		$storeGroup = Self::find($id);
		$storeGroup['group_name'] = $request["group_name"];
		$storeGroup['stores'] = serialize($request["stores"]);
		$storeGroup->save();
		return $storeGroup;
 	}

 	public static function getStoreGroupsForStore($store_number)
    {
    	$banner = StoreInfo::getStoreInfoByStoreId($store_number)->banner_id;
    	$storeGroups = CustomStoreGroup::getGroupsByBanner($banner);	
    	$selectedStoreGroups = [];
    	foreach ($storeGroups as $group) {
    		if(in_array($store_number, $group->stores)){
    			array_push($selectedStoreGroups, $group->id);
    		}
    	}
    	return $selectedStoreGroups;

    }

    public static function getStoreGroupsForAdmin()
    {
    	$adminBanner = UserSelectedBanner::getBanner();
    	$storeGroups = CustomStoreGroup::getGroupsByBanner($adminBanner->id);
    	return $storeGroups;
        
	}
	
	public static function archiveGroup($id)
	{
		Self::find($id)->update(['archived_at' => Carbon::now()->toDateTimeString() ]);
	}

}
