<?php
namespace App\Models\Feature;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Http\Request;
use App\Models\Auth\User\UserSelectedBanner;
use App\Models\Feature\FeatureDocument;
use App\Models\Feature\FeaturePackage;
use App\Http\Requests;
use App\Models\Document\DocumentPackage;
use App\Models\Document\Folder;
use App\Models\Document\FolderPackage;
use App\Models\Document\FileFolder;
use App\Models\Validation\FeatureValidator;
use App\Models\Validation\FeatureThumbnailValidator;
use App\Models\Validation\FeatureBackgroundValidator;
use App\Models\Feature\FeatureCommunicationTypes;
use App\Models\Feature\FeatureTarget;
use App\Models\Communication\Communication;
use App\Models\StoreApi\StoreInfo;
use App\Models\Tools\CustomStoreGroup;
use App\Models\Auth\User\UserBanner;
use App\Models\Utility\Utility;

class Feature extends Model
{
	use SoftDeletes;
    protected $table = 'features';
    protected $dates = ['deleted_at'];
    protected $fillable = ['banner_id', 'title', 'tile_label', 'description', 'start', 'end', 'background_image', 'thumbnail', 'update_type_id', 'update_frequency'];


    public static function validateCreateFeature($request)
    {
        $validateThis = [ 
                        'name'             => $request['name'],
                        'title'            => $request['tileLabel'],
                        'documents'        => json_decode($request['feature_files']),
                        'packages'         => json_decode($request['feature_packages']),
                        'thumbnail'        => $request['thumbnail'],
                        'background'       => $request['background'],
                        'start'            => $request['start'],
                        'end'              => $request['end'],
                        'update_type_id'   => $request['update_type'],
                        'update_frequency' => $request['update_frequency'],
                        'target_stores'    => json_decode($request['target_stores'])
                      ];

        if(null !== json_decode($request['communication_type'])){
            $validateThis['communication_type'] = json_decode($request['communication_type']);
                        
        }

        if(null !== json_decode($request['communications'])){
            $validateThis['communications'] = json_decode($request['communications']);
                        
        }

        if ($request['all_stores'] != NULL) {
            $validateThis['allStores'] = $request['all_stores'];
        }

        $v = new FeatureValidator();

        return $v->validate($validateThis);
    }

    public static function validateEditFeature($id, $request)
    {
        $validateThis = [ 
                        'name'             => $request['title'],
                        'title'            => $request['tileLabel'],
                        'documents'        => $request['feature_files'],
                        'packages'         => $request['feature_packages'],
                        'start'            => $request['start'],
                        'end'              => $request['end'],
                        'update_type_id'   => $request['update_type'],
                        'update_frequency' => $request['update_frequency'],
                        'remove_documents' => $request['remove_document'],
                        'remove_packages'  => $request['remove_package'],
                        'target_stores'    => $request['target_stores']
                      ];

        if(null !== $request['communication_type']){
            $validateThis['communication_type'] = $request['communication_type'];
                        
        }

        if(null !== $request['communications']){
            $validateThis['communications'] = $request['communications'];
                        
        }

        if ($request['all_stores'] != NULL) {
            $validateThis['allStores'] = $request['all_stores'];
        }

        if(isset($request['thumbnail']) && $request['thumbnail']){
            $validateThis['thumbnail']     = $request['thumbnail'];
                        
        }
        if(isset($request['background']) && $request['background']){
            $validateThis['background']    = $request['background'];
        }

        $v = new FeatureValidator();
          
        return $v->validate($validateThis);
    }
  	
    public static function validateThumbnailEdit($request)
    {
         $validateThis = [ 
                        
                        'thumbnail' => $request['thumbnail'],
                        'featureID' => $request['featureID']
                      ];
        
        $v = new FeatureThumbnailValidator();
          
        return $v->validate($validateThis);
    }

    public static function validateBackgroundEdit($request)
    {
         $validateThis = [ 
                        
                        'background'=> $request['background'],
                        'featureID' => $request['featureID']

                      ];
        
        $v = new FeatureBackgroundValidator();
          
        return   $v->validate($validateThis);
        
    }

  	public static function storeFeature(Request $request)
  	{
        \Log::info($request->all());
        $validate = Feature::validateCreateFeature($request);
        
        if($validate['validation_result'] == 'false') {
            \Log::info($validate);
            return json_encode($validate);
        }	
        $title            = $request["name"];
        $tile_label       = $request["tileLabel"];
        $start            = $request["start"];
        $end              = $request["end"];
        $update_type_id   = $request["update_type"];
        $update_frequency = $request["update_frequency"];
        $thumbnail        = $request->file("thumbnail");
        $background_image = $request->file("background");
        $banner           = UserSelectedBanner::getBanner();

        $feature          = Feature::create([
                'banner_id'        => $banner->id,
                'title'            => $title,
                'tile_label'       => $tile_label,
                'start'            => $start,
                'end'              => $end,
                'update_type_id'   => $update_type_id,
                'update_frequency' => $update_frequency,
                'thumbnail'        => 'temp',
                'background_image' => 'temp'

 			]);

  		if(isset($background_image)) {
            Feature::updateFeatureBackground($background_image, $feature->id);  
        }
        if(isset($thumbnail)) {
            Feature::updateFeatureThumbnail($thumbnail, $feature->id);  
        }
      
  		Feature::addFiles(json_decode($request["feature_files"]), $feature->id);
  		Feature::addPackages(json_decode($request['feature_packages']), $feature->id);
        Feature::updateCommunicationTypes(json_decode($request['communication_type']), $feature->id);
        FeatureCommunication::updateFeatureCommunications(json_decode($request['communications']), $feature->id);
        FeatureTarget::updateFeatureTarget($feature->id, $request);

  		return $feature;

  	}  

    public static function updateFeature(Request $request, $id)
    {
        \Log::info($request->all());
        $validate = Feature::validateEditFeature($id, $request);
        
        if($validate['validation_result'] == 'false') {
          \Log::info($validate);
          return json_encode($validate);
        }


        $feature = Feature::find($id);  

        $feature['title'] = $request->title;
        $feature['tile_label'] = $request->tileLabel;
        $feature['start'] = $request->start;
        $feature['end'] = $request->end;
        $feature['update_type_id'] = $request->update_type;
        $feature['update_frequency'] = $request->update_frequency;

        $feature->save();

        Feature::addFiles($request->feature_files, $id);
        Feature::removeFiles($request->remove_document, $id);
        Feature::addPackages($request->feature_packages, $id);
        Feature::removePackages($request->remove_package, $id);
        Feature::updateCommunicationTypes($request['communication_type'], $feature->id);
        FeatureCommunication::updateFeatureCommunications($request['communications'], $feature->id);
        FeatureTarget::updateFeatureTarget($feature->id, $request);
        return $feature;

    }

  	public static function addFiles($feature_files, $feature_id)
  	{
  		
        if (isset($feature_files) && count($feature_files) >0 ) {
    			foreach ($feature_files as $file) {
    				FeatureDocument::create([
    					'feature_id' => $feature_id,
    					'document_id'	 => intval($file)
    					]);
    			}
    		}
        return;
  	}

    public static function removeFiles($feature_files, $feature_id)
    {
        if (isset($feature_files) && count($feature_files) >0 ) {
          foreach ($feature_files as $file) {
            FeatureDocument::where('feature_id', $feature_id)->where('document_id', intval($file))->delete();  
          }
        }
        return;
    }

  	public static function addPackages($feature_packages, $feature_id)
  	{
  		
    		if (isset($feature_packages)) {
    			foreach ($feature_packages as $package) {
    				FeaturePackage::create([
    					'feature_id' => $feature_id,
    					'package_id' => intval($package)
    					]);
    			}
    		}
        return;
  	}

    public static function removePackages($feature_packages, $feature_id)
    {
        if (isset($feature_packages)) {
          foreach ($feature_packages as $package) {
            FeaturePackage::where('feature_id', $feature_id)->where('package_id', intval($package))->delete();  
          }
        }
        return; 
    }

    public static function updateCommunicationTypes($communication_types, $feature_id)
    {
        if(FeatureCommunicationTypes::where('feature_id', $feature_id)->first()){
            $feature = FeatureCommunicationTypes::where('feature_id', $feature_id)->delete();
        }
        if (isset($communication_types)) {   
            
            foreach ($communication_types as $type) {
                FeatureCommunicationTypes::create([
                    'feature_id' => $feature_id,
                    'communication_type_id' => intval($type)
                    ]);
            }
        }
    }

    public static function updateFeatureBackground($file, $feature_id)
    {
        $metadata       = Feature::getFileMetaData($file);

        $directory      = public_path() . '/images/featured-backgrounds/';
        $uniqueHash     = sha1(time() . time());
        $filename       = $metadata["modifiedName"] . "_" . $uniqueHash . "." . $metadata["originalExtension"];

        $upload_success = $file->move($directory, $filename); //move and rename file

        $feature        = Feature::where('id', $feature_id)->update(['background_image' => $filename]);
  
        return $filename;
    }

    public static function updateFeatureThumbnail($file, $feature_id)
    {
        

        $metadata = Feature::getFileMetaData($file);

        $directory = public_path() . '/images/featured-covers/';
        $uniqueHash = sha1(time() . time());
        $filename  = $metadata["modifiedName"] . "_" . $uniqueHash . "." . $metadata["originalExtension"];

        $upload_success = $file->move($directory, $filename); //move and rename file  
        
        $feature = Feature::where('id', $feature_id)->update(['thumbnail' => $filename]);

        return $filename ;
    }

    public static function getFileMetaData($file)
    {
        
        $extension = $file->getClientOriginalExtension();
        $originalName = $file->getClientOriginalName();
        $modifiedName = str_replace(" ", "_", $originalName);
        $modifiedName = str_replace(".", "_", $modifiedName);

        $response = [];
        $response["originalName"] = $originalName;
        $response["modifiedName"] = $modifiedName;
        $response["originalExtension"] = $extension;

        return $response;
    }

    //return ALL documents in a feature : independent documents , docs in packages included , docs in folders in package included
    public static function getDocumentsIdsByFeatureId($id, $store_number)
    {
        $feature_docs = FeatureDocument::getFeaturedDocumentArray($id, $store_number);
        
        $feature_packages = FeaturePackage::getFeaturePackagesArray($id);

        $feature_folders = [];
        
        foreach ($feature_packages as $package_id) {
          
          $package_docs =  DocumentPackage::getDocumentArrayInPackage($package_id, $store_number);
          $feature_docs = array_merge_recursive($feature_docs, $package_docs);
          unset($package_docs);

          $package_folders = FolderPackage::getFolderArrayInPackage($package_id);
          

          foreach ($package_folders as $folderTreeRootId) {
            $folderTree = Folder::getFolderChildrenTree($folderTreeRootId); 
            
            foreach ($folderTree as $folderNode) {
              
              array_push($feature_folders, $folderNode["global_folder_id"]);

            }
            
          }
          
        }
        
        foreach ($feature_folders as $folder_id) {
          $docs = FileFolder::getDocumentArrayInFolder($folder_id, $store_number);
          $feature_docs = array_merge_recursive($feature_docs, $docs);
        }
        $feature_docs = array_unique($feature_docs);
        
        return $feature_docs;
        

    }

    public static function getActiveFeatureByStoreNumber($storeNumber)
    {
        $now = Carbon::now()->toDatetimeString();
        $banner_id = StoreInfo::getStoreInfoByStoreId($storeNumber)->banner_id;

        $allStoreFeatures = Feature::join('feature_banner', 'feature_banner.feature_id', '=', 'features.id')
                                    ->where('all_stores', 1)
                                    ->where('feature_banner.banner_id', $banner_id)
                                    ->where('start', '<=', $now)
                                    ->where(function($query) use ($now) {
                                        $query->where('features.end', '>=', $now)
                                            ->orWhere('features.end', '=', '0000-00-00 00:00:00' ); 
                                    })
                                    ->select('features.*')
                                    ->get();

        $targetedFeatures = Feature::join('feature_target', 'features.id', '=', 'feature_target.feature_id')
                                    ->where('store_id', $storeNumber)
                                    ->where(function($query) use ($now) {
                                        $query->where('features.end', '>=', $now)
                                            ->orWhere('features.end', '=', '0000-00-00 00:00:00' ); 
                                    })
                                    ->select('features.*')
                                    ->get();

        $storeGroups = CustomStoreGroup::getStoreGroupsForStore($storeNumber);

        $targetedFeaturesForStoreGroups = Feature::join('feature_store_group', 'feature_store_group.feature_id', '=', 'features.id')
                                            ->whereIn('feature_store_group.store_group_id', $storeGroups)
                                            ->select('features.*')
                                            ->get();


        $features = $allStoreFeatures->merge($targetedFeatures)
                                    ->merge($targetedFeaturesForStoreGroups)
                                    ->sortBy('order');  
        return $features;                               

    }

    public static function deleteFeature($id)
    {
        Feature::find($id)->delete();
        FeaturePackage::where('feature_id', $id)->delete();
        FeatureDocument::where('feature_id', $id)->delete();
        FeatureFlyer::where('feature_id', $id)->delete();
        return;
    }


    public static function getActiveFeaturesByBanner($banner_id)
    {
        $now = Carbon::now();
        $activeFeatures = Feature::where('banner_id', $banner_id)
                                ->where('features.start', '<=', $now )
                                ->where('features.end', '>=', $now )
                                ->orderBy('order')
                                ->get();

        return $activeFeatures;

        
    }

    public static function getSelectedStoresAndBannersByFeatureId($feature_id)
    {
        $targetBanners = FeatureBanner::where('feature_id', $feature_id)->get()->pluck('banner_id')->toArray();
        $targetStores = FeatureTarget::where('feature_id', $feature_id)->get()->pluck('store_id')->toArray();

        $storeGroups = FeatureStoreGroup::where('feature_id', $feature_id)->get()->pluck('store_group_id')->toArray();

        $optGroupSelections = [];
        foreach ($targetBanners as $banner) {
            array_push($optGroupSelections, 'banner'.$banner);
        }
        foreach ($targetStores as $stores) {
            array_push($optGroupSelections, 'store'.$stores);   
        }
        foreach ($storeGroups as $group) {
            array_push($optGroupSelections, 'storegroup'.$group);   
        }


        return( $optGroupSelections );
    }

    public static function getFeaturesForAdmin()
    {
        $banners = UserBanner::getAllBanners()->pluck('id')->toArray();
        
        //stores in accessible banners
        $storeList = [];
        foreach ($banners as $banner) {
            $storeInfo = StoreInfo::getStoresInfo($banner);
            foreach ($storeInfo as $store) {
                array_push($storeList, $store->store_number);
            }
        }

        $allStoreFeatures = Feature::join('feature_banner', 'feature_banner.feature_id', '=', 'features.id')
                                ->where('all_stores', 1)
                                ->whereIn('feature_banner.banner_id', $banners)
                                ->select('features.*', 'feature_banner.banner_id')
                                ->get();


        $allStoreFeatures = Utility::groupBannersForAllStoreContent($allStoreFeatures);
        
        $targetedFeatures = Feature::join('feature_target', 'feature_target.feature_id', '=', 'features.id')
                                ->whereIn('feature_target.store_id', $storeList)
                                
                                ->select(\DB::raw('features.*, GROUP_CONCAT(DISTINCT feature_target.store_id) as stores'))
                                ->groupBy('features.id')
                                ->get()
                                ->each(function($feature){
                                    $feature->stores = explode(',', $feature->stores);
                                });

        $storeGroups = CustomStoreGroup::getStoreGroupsForAdmin();
        $featuresForStoreGroups = Feature::join('feature_store_group','feature_store_group.feature_id','=','features.id')
                                            ->whereIn('feature_store_group.store_group_id', $storeGroups)
                                            ->select('features.*')
                                            ->get()
                                            ->each(function($item){
                                                $storeGroups = FeatureStoreGroup::where('feature_id', $item->id)->get()->pluck('store_group_id')->toArray();
                                                $item->storeGroups = $storeGroups;
                                                $item->stores = [];
                                                foreach ($storeGroups as $group) {
                                                    $stores = unserialize(CustomStoreGroup::find($group)->stores);
                                                    $item->stores = array_merge($item->stores,$stores);
                                                }
                                                $item->stores = array_unique( $item->stores);
                                            });
        $targetedFeatures = Utility::mergeTargetedAndStoreGroupContent($targetedFeatures, $featuresForStoreGroups);

        $features = Utility::mergeTargetedAndAllStoreContent($targetedFeatures, $allStoreFeatures);


        foreach ($features as $feature) {
            
            $feature->prettyDateCreated = Utility::prettifyDate($feature->created_at);
            $feature->prettyDateUpdated = Utility::prettifyDate($feature->updated_at);
        }
                        
                        
        return $features;
    }


}
