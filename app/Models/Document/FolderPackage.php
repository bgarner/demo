<?php

namespace App\Models\Document;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class FolderPackage extends Model
{
    use SoftDeletes;
    protected $table = 'folder_package';
    protected $fillable = ['folder_id', 'package_id'];
    protected $dates = ['deleted_at'];


    public static function getFolderArrayInPackage($package_id)
    {
    	return self::where('package_id', $package_id)->get()->pluck('folder_id')->toArray();
    }
}
