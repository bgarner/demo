<?php

namespace App\Models\Document;

use Illuminate\Database\Eloquent\Model;
// use Illuminate\Database\Eloquent\SoftDeletes;

class DocumentTarget extends Model
{
    use SoftDeletes;
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

}
