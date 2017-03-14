<?php

namespace App\Http\Controllers\Utilities;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class CkeditorImageController extends Controller
{
     public function store(Request $request)
    {
        \Log::info($request->all());
        $file = $request->file('upload');
        $banner_id = $request->banner_id;
        $directory = public_path() . '/images/ckeditor-images';
        $extension = $file->getClientOriginalExtension();
        $originalName = $file->getClientOriginalName();
        $modifiedName = str_replace(" ", "_", $originalName);
        $modifiedName = str_replace(".", "_", $modifiedName);
        // $modifiedName = "Banner" . $banner_id . "~" .  $modifiedName;
        $uniqueHash = sha1(time() . time());
        $filename  = $modifiedName . "_" . $uniqueHash . "." . $extension;
        $upload_success = $file->move($directory, $filename); //move and rename file

        if($upload_success) {
            
            $imagesrc = $filename;
            $imagefile = public_path() . '/js/custom/ckeditor-imagebrowser/images_list.json';
            $imagefileContent = json_decode(file_get_contents($imagefile));
            
            array_push($imagefileContent , ['image' => '/images/ckeditor-images/' . $filename ]);
            file_put_contents($imagefile, json_encode($imagefileContent));

            $response = [
                            "uploaded" => 1,
                            "fileName" => $filename,
                            "url"=> "/images/ckeditor-images/".$filename,
                        ];

            return json_encode($response);
        }

        $response =  [
                        "uploaded"=> 0,
                        "error" => [ "message"=> "File is too big."]
                        
                    ];
        return json_encode($response);
    }
}
