<?php 

namespace App\Models\StoreApi;

use Illuminate\Database\Eloquent\Model;

class Store extends Model {

    protected $table = 'stores';

    protected $fillable = [];

    protected $dates = [];

    public static $rules = [
        // Validation rules
    ];

    public static function getAllStores($request)
    {
    	if(isset($request['province'])){
    		return Store::getStoreDetailsByProvince($request->province);
    	}
    	if(isset($request['city'])){
    		return Store::getStoreDetailsByCity($request->city);
    	}
    	
    	return Store::join('banner_store', 'banner_store.store_id', '=', 'stores.id')->select('stores.*', 'banner_store.banner_id')->get();
    	
    }

    public static function getAllStoreNameList()
	{
		$stores = Store::select('store_id', 'name', 'city')->get();
                
        $searchList = [];
        foreach ($stores as $store) {
            $searchItem = [
                'value' => $store->store_id,
                'label' => $store->store_id . " - " . $store->name . ", " . $store->city 
            ];
            array_push($searchList, ($searchItem) );
            
        }   
        
        return ( json_encode ( $searchList ) );
	}

	public static function getStoreDetailsByStoreNumber($id)
	{
		$storedetails = Store::join('banner_store', 'banner_store.store_id', '=', 'stores.id')
								->where('store_number', $id)
								->select('stores.*', 'banner_store.banner_id')
								->first();
		if ($storedetails) {
			return $storedetails;
		}else{
			return array();
		}
	}
	
	public static function getStoreDetailsByProvince($province)
	{
		$stores = Store::join('banner_store', 'banner_store.store_id', '=', 'stores.id')
						->where('province', $province)
						->select('stores.*', 'banner_store.banner_id')
						->get();
		if (count($stores) > 0) {
			return $stores;
		}else {
			return array();
		}
	}
	public static function getStoreDetailsByCity($city)
	{
		$city = preg_replace("/\+/", " " , $city);
		$stores = Store::join('banner_store', 'banner_store.store_id', '=', 'stores.id')
						->where('city', $city)
						->select('stores.*', 'banner_store.banner_id')
						->get();
		if ( count($stores) > 0) {
			return $stores;
		}else {
			return array();
		}
		
	}

	public static function getStoreDetailsByDistrictId($id)
    {
    	$stores = Store::join('district_store', 'district_store.store_id', '=', 'stores.id')
    					->join('banner_store', 'banner_store.store_id', '=', 'stores.id')
		                ->where('district_store.district_id', $id)
		                ->select('stores.*', 'banner_store.banner_id')
		                ->get();
        if(count($stores)>0){
    		return $stores;
    	}
    	return [];
    }

    public static function getStoreDetailsByRegionId($id)
    {

    	$districts = District::getDistrictDetailsByRegionId($id);
    	$stores = [];
    	foreach($districts as $district){
    		foreach ($district->stores as $store) {
    			array_push($stores, $store);
    		}
    		
    	}
        if(count($stores)>0){
    		return $stores;
    	}
    	return [];
    }

}
