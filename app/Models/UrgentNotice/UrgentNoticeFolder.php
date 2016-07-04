<?php

namespace App\Models\UrgentNotice;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class UrgentNoticeFolder extends Model
{
    use SoftDeletes;
    protected $table = 'urgent_notice_folders';
    protected $fillable = ['urgent_notice_id' , 'folder_id'];
	protected $dates = ['deleted_at'];    

	public static function updateFolders($folders, $urgent_notice_id)
    {
        UrgentNoticeFolder::where('urgent_notice_id', $urgent_notice_id)->delete();
        foreach ($folders as $folder) {
            UrgentNoticeFolder::create([
                'urgent_notice_id' => $urgent_notice_id,
                'folder_id' => $folder
            ]);
        } 
    }
}
