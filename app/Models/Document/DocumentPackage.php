<?php

namespace App\Models\Document;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DocumentPackage extends Model
{
    use SoftDeletes;
    protected $table = 'document_package';
    protected $fillable = ['document_id', 'package_id'];
    protected $dates = ['deleted_at'];

    public static function getDocumentArrayInPackage($package_id, $store_number)
    {
    	return self::join('document_target', 'document_target.document_id', '=' ,'document_package.document_id')
    						->where('package_id', $package_id )
    						->where('document_target.store_id',$store_number)
    						->where('document_target.deleted_at', null)
    						->get()->pluck('document_id')->toArray();	
    }
    
}
