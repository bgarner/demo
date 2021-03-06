<?php 

namespace App\Models\StoreApi;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable as Notifiable;
use App\Models\Utility\Utility;
use App\Models\Auth\Resource\Resource;

class Store extends Model {
  
	use SoftDeletes;
    use Notifiable;

    protected $table = 'stores';

    protected $fillable = ['store_id', 'store_number', 'banner_id', 'is_combo_store', 'name', 'address', 'city', 'province', 'postal_code'];

    protected $dates = [];

    public static $rules = [
        // Validation rules
    ];
    protected $resource_type = 'store';
    protected static $resource_type_id = 1; 

    public static function getAllStores($request = null)
    {
    	if(isset($request['province'])){
    		return Store::getStoreDetailsByProvince($request->province);
    	}
    	if(isset($request['city'])){
    		return Store::getStoreDetailsByCity($request->city);
    	}
    	
    	return Store::all();
    	
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
		$storedetails = Store::where('store_number', $id)
								->first();
		if ($storedetails) {
			return $storedetails;
		}else{
			return array();
		}
	}
	
	public static function getStoreDetailsByProvince($province)
	{
		$stores = Store::where('province', $province)
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
		$stores = Store::where('city', $city)
						->get();
		if ( count($stores) > 0) {
			return $stores;
		}else {
			return array();
		}
		
	}

	public static function getStoreDetailsByDistrictId($id)
    {
        $stores = Store::join('district_store', 'district_store.store_id', '=', 'stores.store_number')
		                ->where('district_store.district_id', $id)
		                ->select('stores.*')
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
    		return collect($stores);
    	}
    	return [];
    }

    public static function createNewStore($request)
    {
        $banners = Banner::all()->pluck('id');

        if($request->is_combo_store == 'on'){
            foreach($banners as $banner_id){
                $store = Store::create([
                    'store_id'       => intval($request->store_number),
                    'banner_id'      => $banner_id,
                    'store_number'   => Utility::makeStoreNumber($request->store_number, $banner_id, $request->is_combo_store),
                    'is_combo_store' => intval(isset($request->is_combo_store)),
                    'name'           => $request->store_name,
                    'address'        => $request->address,
                    'postal_code'    => $request->postal_code,
                    'city'           => $request->city,
                    'province'       => $request->province

                ]);

                if($store->banner_id == $request->banner_id){
                    Resource::createResource( [ 
                        'resource_type' => Self::$resource_type_id , 
                        'resource_id' => $store->store_id] );
                }
                DistrictStore::updateDistrictStorePivot($store->store_number, $request->district_id);

            }
        }
        else{
            $store = Store::create([
                    'store_id'       => intval($request->store_number),
                    'banner_id'      => $request->banner_id,
                    'store_number'   => Utility::makeStoreNumber($request->store_number, $request->banner_id),
                    'is_combo_store' => intval($request->is_combo_store),
                    'name'           => $request->store_name,
                    'address'        => $request->address,
                    'postal_code'    => $request->postal_code,
                    'city'           => $request->city,
                    'province'       => $request->province
                ]);

            Resource::createResource( [ 
                        'resource_type' => Self::$resource_type_id , 
                        'resource_id' => $store->store_id] );

            DistrictStore::updateDistrictStorePivot($store->store_number, $request->district_id);
        }


        return;
        
    }

    public static function updateStore($id, $request)
    {
        \Log::info($request->all());
        return Store::find($id)->update([
                    
                    'banner_id'      => $request->banner_id,
                    'is_combo_store' => intval($request->is_combo_store),
                    'name'           => $request->store_name,
                    'address'        => $request->address,
                    'postal_code'    => $request->postal_code,
                    'city'           => $request->city,
                    'province'       => $request->province
                ]);
    }

    public static function deleteStore($id)
    {

        $store = Store::find($id);
        DistrictStore::where('store_id', $store->store_number)->delete();
        Resource::where('resource_type_id', Self::$resource_type_id)->where('resource_id', $store->store_id)->delete();
        $store->delete();
        return json_encode(['success'=>'true', 'description'=>'District deleted']);
    }


}
