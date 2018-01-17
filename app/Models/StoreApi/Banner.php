<?php

namespace App\Models\StoreApi;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Log;
use Storage;
use App\Models\Validation\DashboardBrandingValidator;
use App\Models\StoreApi\Store;

class Banner extends Model
{
    protected $table = 'banners';
    protected $fillable = ['name', 'background'];


    public static function validateBannerBackground($request)
    {
        $validateThis = [
            'background' => $request->file('background')
        ];
        \Log::info($validateThis);
        $v = new DashboardBrandingValidator();
        $validationResult = $v->validate($validateThis);
        return $validationResult;
    }

    public static function validateNotifications($request)
    {
        $validateThis = [
            
            'update_type_id' => $request->update_type,
            'update_window_size' => $request->update_frequency,
        ];
        
        \Log::info($validateThis);
        $v = new DashboardBrandingValidator();
        $validationResult = $v->validate($validateThis);
        \Log::info($validationResult);
        return $validationResult;
    }

    public static function validateBranding($request)
    {
        $validateThis = [
            'title' => $request->title
        ];
        \Log::info($validateThis);
        $v = new DashboardBrandingValidator();
        $validationResult = $v->validate($validateThis);
        return $validationResult;
    }

    public static function updateBannerBackground($id, $request)
    {
        
        $validate = Banner::validateBannerBackground($request);
        
        if($validate['validation_result'] == 'false') {
            \Log::info($validate);
            return json_encode($validate);
        } 

        $file = $request->file('background');
        $banner_id = $request->banner_id;
        $directory = public_path() . '/images/dashboard-banners';
		$extension = $file->getClientOriginalExtension();
        $originalName = $file->getClientOriginalName();
        $modifiedName = str_replace(" ", "_", $originalName);
        $modifiedName = str_replace(".", "_", $modifiedName);
        $modifiedName = "Banner" . $banner_id . "~" .  $modifiedName;
		$uniqueHash = sha1(time() . time());
        $filename  = $modifiedName . "_" . $uniqueHash . "." . $extension;
		$upload_success = $file->move($directory, $filename); //move and rename file

        $banner = Banner::find($id);
        $banner->background =$filename;
        $banner->save();
        return json_encode($filename);
    }

    public static function getOldBannerBackgrounds($bannerId)
    {
        $files =  Storage::disk('public')->files('images/dashboard-banners');

        $backgrounds = array();
        foreach($files as $f){
            if(substr($f, 31, 32) == $bannerId){
                array_push($backgrounds, $f);
            }
        }
        return $backgrounds;
    }

    public static function getBannerBackground($id)
    {
    	$banner = Banner::find($id);
    	return $banner->background;
    }

    public static function updateBannerInfo($id,Request $request)
    {
        $requestType = $request->request_type;
        if ($requestType == 'updateNotificationPreference') {
            return Banner::updateNotificationPreference($id, $request);
        }
        else if($requestType == 'updateTitle') {
            return Banner::updateTitle($id, $request);
        }
    }

    public static function updateNotificationPreference($id, Request $request)
    {
        $validate = Banner::validateNotifications($request);
        
        if($validate['validation_result'] == 'false') {
            \Log::info($validate);
            return json_encode($validate);
        } 

        $update_type_id = $request->update_type;
        $update_window_size = $request->update_frequency;

        $banner = Banner::find($id);
        $banner['update_type_id'] = $update_type_id;
        $banner['update_window_size'] = $update_window_size;
        $banner->save();

        return $banner;

    }

    public static function updateTitle($id,Request $request)
    {
        $validate = Banner::validateBranding($request);
        
        if($validate['validation_result'] == 'false') {
            \Log::info($validate);
            return json_encode($validate);
        } 


        $title = $request->title;
        $subtitle = $request->subtitle;

        $banner = Banner::find($id);
        $banner['title'] = $title;
        $banner['subtitle'] = $subtitle;
        $banner->save();

        return $banner;

    }

    public static function getAllBanners()
    {
        $banners = Banner::all();
        if ( count($banners) > 0 ) {
            return $banners;
        }else {
            return array();
        }

    }

    public static function getStoreDetailsByBannerid($id)
    {
        $stores = Store::join('banner_store','stores.id','=','banner_store.store_id')
                    ->where('banner_id', $id)
                    ->select('stores.*', 'banner_store.banner_id')
                    ->get();
        
        if (count($stores) > 0) {
            return $stores;
        }else {
            return array();
        }
    }

    public  static function getStoreDetailsByBannername($banner)
    {
        
        $stores = Store::join('banner_store','stores.id','=','banner_store.store_id')
                    ->join('banners', 'banners.id', '=', 'banner_store.banner_id')
                    ->where('banners.name', $banner)
                    ->select('stores.*', 'banner_store.banner_id')
                    ->get();

        if (count($stores) > 0) {
            return $stores;
        }else {
            return array();
        }
    }
}
