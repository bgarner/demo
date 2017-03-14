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
    protected $fillable = [	'id','launch_date','style_number','vendor_code','dpt_name','sdpt_name','cls_name','style_name','retail_price','tracking','event_type'];


    public static function getActiveProductLaunchByStore($storeNumber)
    {

		$now = Carbon::now()->toDatetimeString();
		
    	$products =  ProductLaunch::join('productlaunch_target', 'productlaunch_target.productlaunch_id' , '=', 'productlaunch.id')
    							->where('store_id', $storeNumber)
				                // ->where('productlaunch.launch_date', '>=', $now)
				                ->orderBy('productlaunch.launch_date')
    							->get()
    							->each(function ($item) {
			                        $item->prettyLaunchDate = Utility::prettifyDate($item->launch_date);
			                        $item->launch_date = ProductLaunch::formatLaunchDate($item->launch_date);                   
			                    });
    	return ($products);
    }

     public static function getActiveProductLaunchByStoreForCalendar($storeNumber)
    {

		$now = Carbon::now()->toDatetimeString();
		
    	$products =  ProductLaunch::join('productlaunch_target', 'productlaunch_target.productlaunch_id' , '=', 'productlaunch.id')
    							->where('store_id', $storeNumber)
				                // ->where('productlaunch.launch_date', '>=', $now)
				                ->select('productlaunch.id', 'productlaunch.launch_date as start', 'productlaunch_target.store_id', 'productlaunch.event_type as event_type_name', 'productlaunch.style_number', 'productlaunch.style_name', 'productlaunch.retail_price')
    							->get()
    							->each(function ($item) {
			                        $item->end = Carbon::createFromFormat('Y-m-d H:i:s', $item->start)->addDay()->toDateTimeString();
			                        $title = $item->event_type_name . " - " . $item->style_number . " - " . $item->style_name . " - Reg. " . $item->retail_price; 
			                        $item->title = addslashes($title);
			                        
			                    });
    	return ($products);
    }

    public static function getActiveProductLaunchByStoreandMonth($storeNumber, $yearMonth)
    {
    	
        $products = ProductLaunch::join('productlaunch_target', 'productlaunch.id', '=', 'productlaunch_target.productlaunch_id')
                    ->where('productlaunch_target.store_id', $storeNumber)
                    ->where('productlaunch.launch_date', 'LIKE', $yearMonth.'%')
                    ->orderBy('productlaunch.launch_date')
                    ->select('productlaunch.id', 'productlaunch.launch_date as start', 'productlaunch_target.store_id', 'productlaunch.event_type as event_type_name','productlaunch.style_number', 'productlaunch.style_name', 'productlaunch.retail_price')
                    ->get()
                    ->each(function ($item) {
                    	$item->end = Carbon::createFromFormat('Y-m-d H:i:s', $item->start)->addDay()->toDateTimeString();
                        $item->prettyDateStart = Utility::prettifyDate($item->start);
                        $item->prettyDateEnd = Utility::prettifyDate($item->end);
                        $item->since = Utility::getTimePastSinceDate($item->start);
                        $item->description = '';
                        $title = $item->event_type_name . " - " . $item->style_number . " - " . $item->style_name . " - Reg. " . $item->retail_price;
                        $item->title = addslashes($title);
                    })
                    ->groupBy(function($event) {
                            return Carbon::parse($event->start)->format('Y-m-d');
                    });
        return $products;
    
    }

    public static function getAllProductLaunches($banner_id)
    {
    	

    	return ProductLaunch::all()
    						->sortBy('launch_date')
    						->each(function ($item) {
			                        $item->prettyLaunchDate = Utility::prettifyDate($item->launch_date);
			                        $item->launch_date = ProductLaunch::formatLaunchDate($item->launch_date);                   
			                    });
    }

    public static function addProductLaunchData($request)
    {
        $productLaunchDocument = $request->file('document');
        $uploadOption = $request->uploadOption;

        $metadata = Document::getDocumentMetaData($productLaunchDocument);

        $directory = public_path() . '/files/productlaunch';
        $uniqueHash = sha1(time() . time());
        $filename  = $metadata["modifiedName"] . "_" . $uniqueHash . "." . $metadata["originalExtension"];

        $upload_success = $request->file('document')->move($directory, $filename); //move and rename file

        if($upload_success){
        	$csvFile = Reader::createFromPath($directory. "/" . $filename);
            \Log::info($request->uploadOption);
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
		$storeList = $storeList = StoreInfo::getAllStoreNumbers();
		foreach ($csvFile as $index => $row) {
        	if($index != 0){
        		if(!empty($row[0])){
	         	$productLaunch = ProductLaunch::create(
	                array(
	                    'launch_date' => (isset($row[0]) ? $row[0] : ''),
	                    'style_number' => (isset($row[1]) ? $row[1] : ''),
	                    'vendor_code' => (isset($row[2]) ? $row[2] : ''),
	                    'dpt_name' => (isset($row[3]) ? $row[3] : ''),
						'sdpt_name' => (isset($row[4]) ? $row[4] : ''),
						'cls_name' => (isset($row[5]) ? $row[5] : ''),
						'style_name' => (isset($row[6]) ? $row[6] : ''),
						'retail_price' => (isset($row[7]) ? $row[7] : ''),
						'tracking' => (isset($row[8]) ? $row[8] : ''),
						'event_type' => (isset($row[11])? $row[11] : '')

	                )
	            );

	         	$target = $row[10];
	            ProductLaunch::createProductLaunchTarget($productLaunch, $target, $storeList);
	        	}
         	}
         } 
	}

	public static function updateRecords($request, $csvFile)
	{
		$storeList = $storeList = StoreInfo::getAllStoreNumbers();
		foreach ($csvFile as $index => $row) {
			\Log::info($row);
			if ($index != 0 && (!empty($row[0]))) {
				$style_number = $row[1];
				$record = ProductLaunch::where('style_number', $style_number)->first();

				$record['launch_date'] = (isset($row[0]) ? $row[0] : '');
	            $record['style_number'] = (isset($row[1]) ? $row[1] : '');
	            $record['vendor_code'] = (isset($row[2]) ? $row[2] : '');
	            $record['dpt_name'] = (isset($row[3]) ? $row[3] : '');
				$record['sdpt_name'] = (isset($row[4]) ? $row[4] : '');
				$record['cls_name'] = (isset($row[5]) ? $row[5] : '');
				$record['style_name'] = (isset($row[6]) ? $row[6] : '');
				$record['retail_price'] = (isset($row[7]) ? $row[7] : '');
				$record['tracking'] = (isset($row[8]) ? $row[8] : '');
				$record['event_type'] = (isset($row[11])? $row[11] : '');


                $record->save();
                ProductLaunch::deleteProductLaunchTarget($record);
				$target = $row[10];
				ProductLaunch::deleteProductLaunchTarget($record, $row[10], $storeList );
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

	public static function createProductLaunchTarget($productLaunch, $targetStores, $storeList)
	{
		$targetStores = preg_replace('/\s+/', '', $targetStores);
		$targetStores = ltrim($targetStores, ",");  
		$targetStores = rtrim($targetStores, ","); 
		$stores = explode(',', $targetStores);

		
		
		foreach ($stores as $key => $value) {
			$store_number = array_search( $value, $storeList);
			if(isset($store_number) && $store_number != '0'){
				ProductLaunchTarget::create([
					'store_id' => $store_number,
					'productlaunch_id' => $productLaunch->id	

				]);	
			}
			
		}
		ProductLaunchTarget::create([
			'store_id' => '0940',
			'productlaunch_id' => $productLaunch->id	

		]);	
	}

	public static function deleteProductLaunchTarget($productLaunch)
	{	
		ProductLaunchTarget::where('productlaunch_id' , $productLaunch->id	)->delete();
		return;
	}

	public static function getLastUpdatedTimestamp()
	{
		return Utility::prettifyDate(ProductLaunch::orderBy('created_at', 'desc')->first()->created_at);

	}
	public static function formatLaunchDate($date)
	{
		if($date == '0000-00-00 00:00:00') {
			return "";
		}
		$prettyDate = Carbon::createFromFormat('Y-m-d H:i:s', $date)->format('Y-m-d');
		return $prettyDate;
	}

}