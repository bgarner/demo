<?php

namespace App\Models\Tools;

use Illuminate\Database\Eloquent\Model;
use App\Models\Validation\CustomStoreGroupValidator;
class CustomStoreGroup extends Model
{
 	protected $table = 'custom_store_group';

 	protected $fillable = ['group_name', 'stores'];

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
 		return CustomStoreGroup::all()->each(function($group){
 			$group->stores = unserialize($group->stores);
 		});
 	}

 	public static function saveStoreGroup($request)
 	{

		\Log::info($request->all());
		$validate = Self::validateCustomStoreGroup($request);
		\Log::info($validate);
		if($validate['validation_result'] == 'false') {
			\Log::info($validate);
			return json_encode($validate);
		}
		
		$storeGroup = Self::create([
			'group_name'   => $request["group_name"],
			'stores' => serialize($request["stores"])
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

}
