<?php

namespace App\Models\Document;

use Illuminate\Database\Eloquent\Model;
use App\Models\StoreApi\Banner;

class DocumentTarget extends Model
{
    // use SoftDeletes;
    protected $table = 'document_target';
    protected $fillable = ['document_id', 'store_id'];
    // protected $dates = ['deleted_at'];

    public static function getTargetStoresForDocument($id)
    {
    	$document = Document::find($id);
     
    	if ($document) {
    		$document_id = $document->id;
    		return DocumentTarget::where('document_id', $document_id)->get()->pluck('store_id')->toArray();
    	}
    	
    	return [];
    }

    public function getTargetStores($id)
    {
        $document = Document::find($id);

        if(isset($document->all_stores) && $document->all_stores){
            $banner = $document->banner_id;
            $stores = Banner::getStoreDetailsByBannerid($banner)->pluck('store_number')->toArray();
        }
        else{
            $stores = DocumentTarget::where('document_id', $id)
                                            ->get()
                                            ->pluck('store_id')
                                            ->toArray();    
        }

        return $stores;    
                                            
    }

}
