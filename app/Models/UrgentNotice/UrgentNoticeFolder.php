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

	public static function addFolders($folders, $urgent_notice_id)
    {
        foreach ($folders as $folder) {
            UrgentNoticeFolder::create([
                'urgent_notice_id' => $urgent_notice_id,
                'folder_id' => $folder
            ]);
        } 
    }

    public static function updateFolders($request, $id)
    {
        $remove_folders = $request['remove_folder'];
        foreach ($remove_folders as $folder) {
            UrgentNoticeFolder::where('urgent_notice_id', $id)->where('folder_id', $folder)->delete();    
        }

        $add_folders = $request['urgentnotice_folders'];
        UrgentNoticeFolder::addFolders($add_folders, $id);
        
    }
}
