<?php

namespace App\Models\UrgentNotice;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Utility\Utility;

class UrgentNoticeFolder extends Model
{
    use SoftDeletes;
    protected $table = 'urgent_notice_folders';
    protected $fillable = ['urgent_notice_id' , 'folder_id'];
	protected $dates = ['deleted_at'];    

	public static function addFolders($folders, $urgent_notice_id)
    {
        if (isset($folders) && count($folders)>0) {
            foreach ($folders as $folder) {
                UrgentNoticeFolder::create([
                    'urgent_notice_id' => $urgent_notice_id,
                    'folder_id' => $folder
                ]);
            }     
        }
        
    }

    public static function updateFolders($request, $id)
    {
        $remove_folders = $request['remove_folder'];
        if(isset($remove_folders) && count($remove_folders)>0) {
            foreach ($remove_folders as $folder) {
               UrgentNoticeFolder::where('urgent_notice_id', $id)->where('folder_id', $folder)->delete();    
            }    
        }
        

        $add_folders = $request['urgentnotice_folders'];
        UrgentNoticeFolder::addFolders($add_folders, $id);
        
    }


    public static function getFolders($urgent_notice_id)
    {
        $folders = UrgentNoticeFolder::join('folder_ids', 'folder_ids.id', '=', 'urgent_notice_folders.folder_id')
                     ->join('folders', 'folders.id', '=', 'folder_ids.folder_id')
                     ->where('urgent_notice_folders.urgent_notice_id', $urgent_notice_id)
                     ->select('folders.*', 'folder_ids.id as global_folder_id')
                     ->get()
                     ->each(function($folder){
                            $folder->since = Utility::getTimePastSinceDate($folder->updated_at);
                            $folder->prettyDate = Utility::prettifyDate($folder->updated_at);
                     });

        return $folders;

    }

    public static function deleteFolder($folder_id)
    {
        UrgentNoticeFolder::where('folder_id', $folder_id)->delete();    
    }
}
