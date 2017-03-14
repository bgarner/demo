<?php namespace App\Models\Feature;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Http\Request;
use App\Models\UserSelectedBanner;
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

class Feature extends Model
{
	  use SoftDeletes;
    protected $table = 'features';
    protected $dates = ['deleted_at'];
    protected $fillable = ['banner_id', 'title', 'tile_label', 'description', 'start', 'end', 'background_image', 'thumbnail', 'update_type_id', 'update_frequency'];


    public static function validateCreateFeature($request)
    {
        $validateThis = [ 
                        'name'      => $request['name'],
                        'title'     => $request['tileLabel'],
                        'documents' => json_decode($request['feature_files']),
                        'packages'  => json_decode($request['feature_packages']),
                        'thumbnail' => $request['thumbnail'],
                        'background'=> $request['background'],
                        'start'     => $request['start'],
                        'end'       => $request['end'],
                        'update_type_id'    => $request['update_type'],
                        'update_frequency'  => $request['update_frequency']
                      ];
        
        $v = new FeatureValidator();
          
        return $v->validate($validateThis);
    }

    public static function validateEditFeature($id, $request)
    {
        $validateThis = [ 
                        'name'      => $request['title'],
                        'title'     => $request['tileLabel'],
                        'documents' => $request['feature_files'],
                        'packages'  => $request['feature_packages'],
                        'thumbnail' => $request['thumbnail'],
                        'background'=> $request['background'],
                        'start'     => $request['start'],
                        'end'       => $request['end'],
                        'update_type_id'    => $request['update_type'],
                        'update_frequency'  => $request['update_frequency'],
                        'remove_documents'  => $request['remove_document'],
                        'remove_packages'   => $request['remove_package']
                      ];

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
  	  
      $validate = Feature::validateCreateFeature($request);
        
      if($validate['validation_result'] == 'false') {
        \Log::info($validate);
        return json_encode($validate);
      }	
      $title = $request["name"];
  		$tile_label = $request["tileLabel"];
  		$start = $request["start"];
  		$end = $request["end"];
      $update_type_id = $request["update_type"];
      $update_frequency = $request["update_frequency"];
  		$thumbnail = $request->file("thumbnail");
  		$background_image = $request->file("background");
  		$banner = UserSelectedBanner::getBanner();

  		$feature = Feature::create([
  				'banner_id'     => $banner->id,
  				'title' 		    => $title,
  				'tile_label'	  => $tile_label,
  				'start'         => $start,
  				'end' 			    => $end,
  				'update_type_id'=> $update_type_id,
  				'update_frequency' => $update_frequency,
          'thumbnail'     => 'temp',
          'background_image' =>'temp'

 			]);

  		if(isset($background_image)) {
        Feature::updateFeatureBackground($background_image, $feature->id);  
      }
      if(isset($thumbnail)) {
        Feature::updateFeatureThumbnail($thumbnail, $feature->id);  
      }
      
  		Feature::addFiles(json_decode($request["feature_files"]), $feature->id);
  		Feature::addPackages(json_decode($request['feature_packages']), $feature->id);

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
    					'package_id'	 => intval($package)
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


    public static function updateFeatureBackground($file, $feature_id)
    {
        $metadata = Feature::getFileMetaData($file);

        $directory = public_path() . '/images/featured-backgrounds/';
        $uniqueHash = sha1(time() . time());
        $filename  = $metadata["modifiedName"] . "_" . $uniqueHash . "." . $metadata["originalExtension"];

        $upload_success = $file->move($directory, $filename); //move and rename file  

        $feature = Feature::where('id', $feature_id)->update(['background_image' => $filename]);
  
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

    public static function getActiveFeatureByBannerId($banner_id)
    {
        $now = Carbon::now()->toDatetimeString();
        return Feature::where('banner_id', $banner_id)
              ->where('start', '<=', $now)
               ->where(function($query) use ($now) {
                    $query->where('features.end', '>=', $now)
                        ->orWhere('features.end', '=', '0000-00-00 00:00:00' ); 
                })
              ->orderBy('order')->get();

    }

    public static function deleteFeature($id)
    {
        Feature::find($id)->delete();
        FeaturePackage::where('feature_id', $id)->delete();
        FeatureDocument::where('feature_id', $id)->delete();
        return;
    }

    public static function getTopListedDocumentsByFeatureId($feature_id)
    {
        $documents =  FeatureDocument::join('documents', 'feature_document.document_id', '=', 'documents.id')
                                    ->where('feature_id', $feature_id)->get();
        return $documents; 
    }

    public static function getPackageDetailsByFeatureId($feature_id)
    {
        $packages = FeaturePackage::join('packages', 'feature_package.package_id', '=', 'packages.id')
                                ->where('feature_package.feature_id', '=', $feature_id)->get();
        return $packages;
    }
}
