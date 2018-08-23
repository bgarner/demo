<?php

namespace App\Models\Tools\FlashSale;

use Illuminate\Database\Eloquent\Model;
use App\Models\Document\Document;     
use League\Csv\Reader;
use App\Models\Utility\Utility;

class FlashSale extends Model
{
    protected $table = 'flash_sale';
    protected $fillable = [ 'store_number', 'store_name', 'department', 'subdepartment', 'class', 'subclass', 'style_number', 'style_name', 'colour', 'size', 'on_hand', 'sale_date'  ];

    public static function getDataByStoreNumber($store_number)
    {
    	//strip off the leading zero
	    $store_number = ltrim($store_number, 'A');
		$store_number = ltrim($store_number, '0');
		$data = FlashSale::where('store_number', $store_number)->get();
    	return $data;
    }

    public static function getLastUpdatedDate()
    {
        $record = FlashSale::orderBy('created_at', 'desc')->first();
        if($record){
            $date = Utility::prettifyDateWithTime($record->updated_at);
            return $date;
        }
        return "";
    }

    public static function getSaleDate($store_number)
    {
        $store_number = ltrim($store_number, 'A');
        $store_number = ltrim($store_number, '0');
        $sale = FlashSale::where('store_number', $store_number )->first();

        if(!$sale){
            return;
        }
        return Utility::prettifyDate($sale->sale_date);
    }

    public static function getAllFlashSaleData()
    {

        return $flashSaleData = \DB::select( 
                                    \DB::raw( 
                                        "Select style_number,
                                        department, subdepartment, class, subclass, style_name,
                                        COUNT(DISTINCT `store_number`) as total_stores 
                                        from `flash_sale` group by `style_number`;"
                                    ) 
                                );

            // ->each(function ($item) {
            //         $item->prettySaleDate = Utility::prettifyDate($item->sale_date);
            //     });
    }

    public static function addFlashSaleData($request)
    {
        $flashSaleDocument = $request->file('document');
        $uploadOption = $request->uploadOption;

        $metadata = Document::getDocumentMetaData($flashSaleDocument);

        $directory = public_path() . '/files/FlashSale';
        $uniqueHash = sha1(time() . time());
        $filename  = $metadata["modifiedName"] . "_" . $uniqueHash . "." . $metadata["originalExtension"];

        $upload_success = $request->file('document')->move($directory, $filename); //move and rename file

        if($upload_success){
            $csvFile = Reader::createFromPath($directory. "/" . $filename);
            
            switch($request->uploadOption){

                case "clear":
                    FlashSale::rollbackFlashSale();
                    FlashSale::insertRecords($request, $csvFile);
                    break;

                default:
                    FlashSale::insertRecords($request, $csvFile);
                    break;
            }
        }
    }

    public static function insertRecords($request, $csvFile)
    {
        foreach ($csvFile as $index => $row) {
            if($index != 0){
                if(!empty($row[0])){
                $FlashSale = FlashSale::create(
                    array(
                        'store_number' => (isset($row[1]) ? $row[1] : ''),
                        'store_name' => (isset($row[2]) ? $row[2] : ''),
                        'department' => (isset($row[3]) ? $row[3] : ''),
                        'subdepartment' => (isset($row[4]) ? $row[4] : ''),
                        'class' => (isset($row[5]) ? $row[5] : ''),
                        'subclass' => (isset($row[6]) ? $row[6] : ''),
                        'style_number' => (isset($row[8]) ? $row[8] : ''),
                        'style_name' => (isset($row[9]) ? $row[9] : ''),
                        'colour' => (isset($row[10])? $row[10] : ''),
                        'size' => (isset($row[11]) ? $row[11] : ''),
                        'on_hand' => (isset($row[12])? $row[12] : ''),
                        // 'sale_date' => $request->sale_date
                        'sale_date' => $request->sale_date
                    )
                );
                }
            }
         }
    }

    public static function rollbackFlashSale()
    {
        \DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        FlashSale::truncate();
        \DB::statement('SET FOREIGN_KEY_CHECKS=1;');

    }
}
