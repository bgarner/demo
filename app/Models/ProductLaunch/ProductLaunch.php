<?php

namespace App\Models\ProductLaunch;

use Illuminate\Database\Eloquent\Model;
use App\Models\Document\Document;
use League\Csv\Reader;
use App\Models\Utility\Utility;

class ProductLaunch extends Model
{
    protected $table = 'productlaunch';
    protected $fillable = [	'id','store_style','store_number','banner_id', 'store_name','dpt_number','dpt_name','sdpt_number','sdpt_name','cls_number','cls_name','scls_number','scls_name','brand','style_number','style_name','clr_code','clr_name','launch_date','created_at','updated_at'];


    public static function getProductLaunchByStore($storeNumber){

    	$storeNumber = ltrim($storeNumber, 'A');
		$storeNumber = ltrim($storeNumber, '0');
    	$products =  ProductLaunch::where('store_number', $storeNumber)

    							->get()
    							->each(function ($item) {
			                        $item->prettyLaunchDate = Utility::prettifyDate($item->launch_date);                   
			                    });
    	return ($products);
    }

    public static function getAllProductLaunches($banner_id)
    {
    	return ProductLaunch::where('banner_id', $banner_id)->orderBy('launch_date', 'desc')
    						->get()
    						->each(function ($item) {
			                        $item->prettyLaunchDate = Utility::prettifyDate($item->launch_date);                   
			                    });
    }

    public static function storeProductLaunchData($request)
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
        	$csv = Reader::createFromPath($directory. "/" . $filename);
            if($request->uploadOption == 'clear'){
            	ProductLaunch::truncate();	
            }
            
            foreach ($csv as $index => $row) {
            	if($index != 0){
             	ProductLaunch::create(

	                array(
	                    'store_style' => (isset($row[1]) ? $row[1] : ''),
	                    'store_number' => (isset($row[2]) ? $row[2] : ''),
	                    'banner_id' => (isset($row[3]) ? $row[3] : ''),
	                    'store_name' => (isset($row[4]) ? $row[4] : ''),
	                    'dpt_number' => (isset($row[5]) ? $row[5] : ''),
	                    'dpt_name' => (isset($row[6]) ? $row[6] : ''),
	                    'sdpt_number' => (isset($row[7]) ? $row[7] : ''),
	                    'sdpt_name' => (isset($row[8]) ? $row[8] : ''),
	                    'cls_number' => (isset($row[9]) ? $row[9] : ''),
	                    'cls_name' => (isset($row[10]) ? $row[10] : ''),
	                    'scls_number' => (isset($row[11]) ? $row[11] : ''),
	                    'scls_name' => (isset($row[12]) ? $row[12] : ''),
	                    'brand' => (isset($row[13]) ? $row[13] : ''),
	                    'style_number' => (isset($row[14]) ? $row[14] : ''),
	                    'style_name' => (isset($row[15]) ? $row[15] : ''),
	                    'clr_code' => (isset($row[16]) ? $row[16] : ''),
	                    'clr_name' => (isset($row[17]) ? $row[17] : ''),
	                    'launch_date' => (isset($row[18]) ? $row[18] : '')
	                )
	            );
             	}
             } 

    	}	
	}
}