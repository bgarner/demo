<?php

namespace App\Models\ProductLaunch;

use Illuminate\Database\Eloquent\Model;
use App\Models\Document\Document;
use League\Csv\Reader;
use App\Models\Utility\Utility;
use Carbon\Carbon;
use App\Models\ProductLaunch\ProductLaunchTarget;
use App\Models\StoreInfo;

class ProductLaunch extends Model
{
    protected $table = 'productlaunch';
    protected $fillable = [	'id','store_style','banner_id','dpt_number','dpt_name','sdpt_number','sdpt_name','cls_number','cls_name','scls_number','scls_name','brand','style_number','style_name','clr_code','clr_name','launch_date','title','event_type', 'created_at','updated_at'];


    public static function getActiveProductLaunchByStore($storeNumber)
    {

		$now = Carbon::now()->toDatetimeString();
		
    	$products =  ProductLaunch::join('productlaunch_target', 'productlaunch_target.productlaunch_id' , '=', 'productlaunch.id')
    							->where('store_id', $storeNumber)
				                ->where('productlaunch.launch_date', '>=', $now)
    							->get()
    							->each(function ($item) {
			                        $item->prettyLaunchDate = Utility::prettifyDate($item->launch_date);                   
			                    });
    	return ($products);
    }

     public static function getActiveProductLaunchByStoreForCalendar($storeNumber)
    {

		$now = Carbon::now()->toDatetimeString();
		
    	$products =  ProductLaunch::join('productlaunch_target', 'productlaunch_target.productlaunch_id' , '=', 'productlaunch.id')
    							->where('store_id', $storeNumber)
				                ->where('productlaunch.launch_date', '>=', $now)
				                ->select('productlaunch.id', 'productlaunch.launch_date as start', 'productlaunch.title', 'productlaunch_target.store_id', 'productlaunch.event_type as event_type_name')
    							->get()
    							->each(function ($item) {
			                        $item->end = Carbon::createFromFormat('Y-m-d H:i:s', $item->start)->addDay()->toDateTimeString();
			                        
			                    });
    	return ($products);
    }

    public static function getActiveProductLaunchByStoreandMonth($storeNumber, $yearMonth)
    {
    
        $products = ProductLaunch::join('productlaunch_target', 'productlaunch.id', '=', 'productlaunch_target.productlaunch_id')
                    ->where('store_id', $storeNumber)
                    ->where('launch_date', 'LIKE', $yearMonth.'%')
                    ->orderBy('launch_date')
                    ->select('productlaunch.id', 'productlaunch.launch_date as start', 'productlaunch.title', 'productlaunch_target.store_id', 'productlaunch.event_type as event_type_name', 'productlaunch.banner_id')
                    ->get()
                    ->each(function ($item) {
                    	$item->end = Carbon::createFromFormat('Y-m-d H:i:s', $item->start)->addDay()->toDateTimeString();
                        $item->prettyDateStart = Utility::prettifyDate($item->start);
                        $item->prettyDateEnd = Utility::prettifyDate($item->end);
                        $item->since = Utility::getTimePastSinceDate($item->start);
                        // $item->event_type_name = EventType::getName($item->event_type);                        
                    })
                    ->groupBy(function($event) {
                            return Carbon::parse($event->start)->format('Y-m-d');
                    });
                    
        return $products;
    
    }

    public static function getAllProductLaunches($banner_id)
    {
    	

    	return ProductLaunch::where('banner_id', $banner_id)->orderBy('launch_date', 'desc')
    						->get()
    						->each(function ($item) {
			                        $item->prettyLaunchDate = Utility::prettifyDate($item->launch_date);                   
			                    });
    }

    public static function addProductLaunchData($request)
    {
        $banner_id = $request->banner_id;
        $productLaunchDocument = $request->file('document');
        $uploadOption = $request->uploadOption;

        $metadata = Document::getDocumentMetaData($productLaunchDocument);

        $directory = public_path() . '/files/productlaunch';
        $uniqueHash = sha1(time() . time());
        $filename  = $metadata["modifiedName"] . "_" . $uniqueHash . "." . $metadata["originalExtension"];

        $upload_success = $request->file('document')->move($directory, $filename); //move and rename file

        if($upload_success){
        	$csvFile = Reader::createFromPath($directory. "/" . $filename);
            
            switch($request->uploadOption){
	    		case "clear":
	    			
	    			ProductLaunch::rollbackProductLaunch();
	    			ProductLaunch::insertRecords($request, $csvFile);	
	    			break;
	    		
	    		case "patch":
	    			ProductLaunch::updateRecords($request, $csvFile);
	    			break;

	    		default:
	    			ProductLaunch::insertRecords($request, $csvFile);
	    			break;
	    	}
            
            

    	}	
	}

	public static function insertRecords($request, $csvFile)
	{
		foreach ($csvFile as $index => $row) {
        	if($index != 0){
	         	$productLaunch = ProductLaunch::create(

	                array(
	                    'store_style' => (isset($row[1]) ? $row[1] : ''),
	                    'banner_id' => $request->banner_id,
	                    'dpt_number' => (isset($row[3]) ? $row[3] : ''),
	                    'dpt_name' => (isset($row[4]) ? $row[4] : ''),
	                    'sdpt_number' => (isset($row[5]) ? $row[5] : ''),
	                    'sdpt_name' => (isset($row[6]) ? $row[6] : ''),
	                    'cls_number' => (isset($row[7]) ? $row[7] : ''),
	                    'cls_name' => (isset($row[8]) ? $row[8] : ''),
	                    'scls_number' => (isset($row[9]) ? $row[9] : ''),
	                    'scls_name' => (isset($row[10]) ? $row[10] : ''),
	                    'brand' => (isset($row[11]) ? $row[11] : ''),
	                    'style_number' => (isset($row[12]) ? $row[12] : ''),
	                    'style_name' => (isset($row[13]) ? $row[13] : ''),
	                    'clr_code' => (isset($row[14]) ? $row[14] : ''),
	                    'clr_name' => (isset($row[15]) ? $row[15] : ''),
	                    'launch_date' => (isset($row[16]) ? $row[16] : ''),
	                    'title' => (isset($row[19])? $row[19]: ''),
						'event_type' => (isset($row[20])? $row[20] : '')
	                )
	            );

	         	$target = $row[2];
	            ProductLaunch::createProductLaunchTarget($productLaunch, $target);

         	}
         } 
	}

	public static function updateRecords($request, $csvFile)
	{
		foreach ($csvFile as $index => $row) {
		
			if ($index != 0) {
				$store_style = $row[1];
				$record = ProductLaunch::where('store_style', $store_style)->first();
                $record['banner_id'] = $request->banner_id;
                $record['dpt_number'] = (isset($row[3]) ? $row[3] : '');
                $record['dpt_name'] = (isset($row[4]) ? $row[4] : '');
                $record['sdpt_number'] = (isset($row[5]) ? $row[5] : '');
                $record['sdpt_name'] = (isset($row[6]) ? $row[6] : '');
                $record['cls_number'] = (isset($row[7]) ? $row[7] : '');
                $record['cls_name'] = (isset($row[8]) ? $row[8] : '');
                $record['scls_number'] = (isset($row[9]) ? $row[9] : '');
                $record['scls_name'] = (isset($row[10]) ? $row[10] : '');
                $record['brand'] = (isset($row[11]) ? $row[11] : '');
                $record['style_number'] = (isset($row[12]) ? $row[12] : '');
                $record['style_name'] = (isset($row[13]) ? $row[13] : '');
                $record['clr_code'] = (isset($row[14]) ? $row[14] : '');
                $record['clr_name'] = (isset($row[15]) ? $row[15] : '');
                $record['launch_date'] = (isset($row[16]) ? $row[16] : '');
                $record['title'] = (isset($row[19])? $row[19]: '');
				$record['event_type'] = (isset($row[20])? $row[20] : '');
                $record->save();

			}
		}
	}

	public static function rollbackProductLaunch()
	{
		\DB::statement('SET FOREIGN_KEY_CHECKS=0;');
		ProductLaunchTarget::truncate();
		ProductLaunch::truncate();
		\DB::statement('SET FOREIGN_KEY_CHECKS=1;');

	}

	public static function createProductLaunchTarget($productLaunch, $targetStores)
	{
		$stores = explode(';', $targetStores);
		if($stores[count($stores) -1 ] == 0){
			array_pop($stores);
		}

		$storeList = StoreInfo::getStoreListingForStoreNumberOffset($productLaunch->banner_id);
		// dd($storeList);
		
		$banner_id = $productLaunch->banner_id;
		
		foreach ($stores as $key => $value) {
			if(isset($storeList[$value])){
				ProductLaunchTarget::create([
					'store_id' => $storeList[$value],
					'productlaunch_id' => $productLaunch->id	

				]);	
			}
			
		}
	}

}