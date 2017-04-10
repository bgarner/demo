<?php

namespace App\Models\Flyer;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Document\Document;
use League\Csv\Reader;
use App\Models\Validation\FlyerItemValidator;

class FlyerItem extends Model
{
	use SoftDeletes;
    protected $table = 'flyer_data';
    protected $dates = ['deleted_at'];
    protected $fillable = ['flyer_id', 'category', 'brand_name', 'product_name', 'pmm', 'disclaimer', 'original_price', 'sale_price', 'notes'];


    public static function validateFlyerItem($flyer_id)
    {
        $validateThis =  [

            'flyer_id' => $flyer_id
        ];

        \Log::info($validateThis);
        $v = new FlyerItemValidator();
        return $v->validate($validateThis);

    }


    public static function getFlyerItemsByFlyerId($id)
    {
    	$banner_id = Flyer::find($id)->banner_id;
        $flyerItems = Self::where('flyer_id', $id)->get();

    	foreach($flyerItems as $fi){

    		$pmm_array = unserialize($fi->pmm);
            $colour_array = unserialize($fi->colour);
    		$images = array();
            foreach($pmm_array as $key=>$item){
                if($banner_id == 1){
                    
                    $image = array(
                    // "thumb" => "https://fgl.scene7.com/is/image/FGLSportsLtd/".$item."_99_a?bgColor=0,0,0,0&fmt=jpg&hei=50&resMode=sharp2&op_sharpen=1",
                    // "full" => "https://fgl.scene7.com/is/image/FGLSportsLtd/".$item."_99_a?bgColor=0,0,0,0&fmt=jpg&hei=800&resMode=sharp2&op_sharpen=1"


                    "thumb" => "https://fgl.scene7.com/is/image/FGLSportsLtd/".$item."_" . $colour_array[$key] . "_a?bgColor=0,0,0,0&fmt=jpg&hei=50&resMode=sharp2&op_sharpen=1",
                    "full" => "https://fgl.scene7.com/is/image/FGLSportsLtd/".$item."_" . $colour_array[$key] . "_a?bgColor=0,0,0,0&fmt=jpg&hei=800&resMode=sharp2&op_sharpen=1"
                    );
                    $images[$item] = $image;
                }
                else if($banner_id == 2){
                    $image = array(

                    // "thumb" => "https://s7d2.scene7.com/is/image/atmosphere/".$item."_99_a?bgColor=0,0,0,0&fmt=jpg&hei=50&op_sharpen=1&resMode=sharp2",
                    // "full" => "https://s7d2.scene7.com/is/image/atmosphere/".$item."_99_a?bgColor=0,0,0,0&fmt=jpg&hei=800&op_sharpen=1&resMode=sharp2"

                    "thumb" => "https://s7d2.scene7.com/is/image/atmosphere/".$item."_" . $colour_array[$key] . "_a?bgColor=0,0,0,0&fmt=jpg&hei=50&op_sharpen=1&resMode=sharp2",
                    "full" => "https://s7d2.scene7.com/is/image/atmosphere/".$item."_" . $colour_array[$key] . "_a?bgColor=0,0,0,0&fmt=jpg&hei=800&op_sharpen=1&resMode=sharp2"
                    );
                    $images[$item] = $image;
                }
                
            }
    		$fi->pmm_numbers = $pmm_array;
    		$fi->images = $images;

    	}
        
    	return $flyerItems;
    }

    public static function getFlyerItemById($id)
    {
        $flyerItem = Self::find($id);

        $flyerItem->pmm_numbers = unserialize($flyerItem->pmm);

        return $flyerItem;
    }

    public static function addFlyerItems($request, $flyer_id)
    {
        $validate = Self::validateFlyerItem($flyer_id);
        if($validate['validation_result'] == 'false') {
            \Log::info($validate);
            return json_encode($validate);
        }

        $flyerDocument = $request->file('document');

        $metadata = Document::getDocumentMetaData($flyerDocument);

        $directory = public_path() . '/files/flyer';
        $uniqueHash = sha1(time() . time());
        $filename  = $metadata["modifiedName"] . "_" . $uniqueHash . "." . $metadata["originalExtension"];

        $upload_success = $request->file('document')->move($directory, $filename); 

        if($upload_success){
                       
            $csvFile = Reader::createFromPath($directory. "/" . $filename);
            Self::insertRecords($csvFile, $flyer_id);

        }
    }

    public static function createFlyerItem($request)
    {
        $validate = Self::validateFlyerItem($request->flyer_id);
        if($validate['validation_result'] == 'false') {
            \Log::info($validate);
            return json_encode($validate);
        } 

        Self::create(
                        [
                            'flyer_id' => $request->flyer_id,
                            'category' => $request->category,
                            'brand_name' => $request->brand_name,
                            'product_name' => $request->product_name,
                            'pmm' => serialize($request->pmm),
                            'disclaimer' => $request->disclaimer,
                            'original_price' => $request->original_price,
                            'sale_price' => $request->sale_price,
                            'notes' => $request->notes
                            
                        ]
                    );
    }

    public static function updateFlyerItem($id, $request)
    {

        $flyerItem = Self::find($id);
        $flyerItem['category'] = $request->category;
        $flyerItem['brand_name'] = $request->brand_name;
        $flyerItem['product_name'] = $request->product_name;
        $flyerItem['pmm'] = serialize( $request->pmm );
        $flyerItem['disclaimer'] = $request->disclaimer;
        $flyerItem['original_price'] = $request->original_price;
        $flyerItem['sale_price'] = $request->sale_price;
        $flyerItem['notes'] = $request->notes;

        $flyerItem->save();

        return;
    }


    public static function deleteFlyerItem($id)
    {
        $flyerItem = Self::find($id)->delete();

    }

    public static function insertRecords($csvFile, $flyer_id)
    {
        foreach ($csvFile as $index => $row) {
            \Log::info($row);
            if($index != 0){
                if(!empty($row[0])){

                    Self::create(
                        [
                            'flyer_id' => $flyer_id,
                            'category' => (isset($row[0]) ? $row[0] : ''),
                            'brand_name' => (isset($row[1]) ? $row[1] : ''),
                            'product_name' => (isset($row[2]) ? $row[2] : ''),
                            'pmm' => (isset($row[3]) ? serialize(explode( ';',$row[3])) : ''),
                            'disclaimer' => (isset($row[4]) ? $row[4] : ''),
                            'original_price' => (isset($row[5]) ? $row[5] : ''),
                            'sale_price' => (isset($row[6]) ? $row[6] : ''),
                            'notes' => (isset($row[7]) ? $row[7] : '')
                            
                        ]
                    );

                }
            }
         } 
    }


}
