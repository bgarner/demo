<?php

namespace App\Models\Flyer;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class FlyerData extends Model
{
	use SoftDeletes;
    protected $table = 'flyer_data';
    protected $dates = ['deleted_at'];
    protected $fillable = ['category', 'brand_name', 'product_name', 'pmm', 'disclaimer', 'original_price', 'sale_price', 'notes'];


    public static function getFlyerData()
    {
    	$flyerItems = Self::all();

    	foreach($flyerItems as $fi){

    		$pmm_array = unserialize($fi->pmm);
    		$image_url_array = array();

    		foreach($pmm_array as $item){
    			array_push($image_url_array, "https://fgl.scene7.com/is/image/FGLSportsLtd/".$item."_99_a?bgColor=0,0,0,0&fmt=png-alpha&hei=200&resMode=sharp2&op_sharpen=1");
    		}
    		$fi->pmm_numbers = $pmm_array;
    		$fi->image_urls = $image_url_array;

    	}

    	return $flyerItems;
    }

    public static function getFlyerDataById($id)
    {
        $flyerData = Self::find($id);

        $flyerData->pmm_numbers = unserialize($flyerData->pmm);

        return $flyerData;
    }

    public static function addFlyerData($request)
    {
        $flyerDocument = $request->file('document');

        $metadata = Document::getDocumentMetaData($flyerDocument);

        $directory = public_path() . '/files/flyer';
        $uniqueHash = sha1(time() . time());
        $filename  = $metadata["modifiedName"] . "_" . $uniqueHash . "." . $metadata["originalExtension"];

        $upload_success = $request->file('document')->move($directory, $filename); 

        if($upload_success){
            $csvFile = Reader::createFromPath($directory. "/" . $filename);
            FlyerData::insertRecords($request, $csvFile);

        }
    }

    public static function updateFlyerData($id, $request)
    {
        $flyerData = FlyerData::find($id);
        $flyerData['category'] = $request->category;
        $flyerData['brand_name'] = $request->brand_name;
        $flyerData['product_name'] = $request->product_name;
        $flyerData['pmm'] = serialize( $request->pmm );
        $flyerData['disclaimer'] = $request->disclaimer;
        $flyerData['original_price'] = $request->original_price;
        $flyerData['sale_price'] = $request->sale_price;
        $flyerData['notes'] = $request->notes;
        // $flyerData['start_date'] = $request->start_date;
        // $flyerData['end_date'] = $request->end_date;

        $flyerData->save();

        return;
    }


    public static function deleteFlyerData($id)
    {
        $flyerData = Self::find($id)->delete();

    }

    public static function insertRecords($request, $csvFile)
    {
        foreach ($csvFile as $index => $row) {
            if($index != 0){
                if(!empty($row[0])){
                $productLaunch = Flyer::create(
                    [
                        'category' => (isset($row[0]) ? $row[0] : ''),
                        'brand_name' => (isset($row[1]) ? $row[1] : ''),
                        'product_name' => (isset($row[2]) ? $row[2] : ''),
                        'pmm' => (isset($row[3]) ? serialize($row[3]) : ''),
                        'disclaimer' => (isset($row[4]) ? $row[4] : ''),
                        'original_price' => (isset($row[5]) ? $row[5] : ''),
                        'sale_price' => (isset($row[6]) ? $row[6] : ''),
                        'notes' => (isset($row[7]) ? $row[7] : ''),
                        'start_date' => (isset($row[7]) ? $row[7] : ''),
                        'end_date' => (isset($row[7]) ? $row[7] : ''),
                        
                    ]
                );

                }
            }
         } 
    }
}
