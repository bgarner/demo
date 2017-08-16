<?php

namespace App\Models\UrgentNotice;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\StoreApi\Banner;

class UrgentNoticeTarget extends Model
{
	use SoftDeletes;
    protected $table = 'urgent_notice_target';

    protected $fillable = ['urgent_notice_id', 'store_id', 'is_read'];
    protected $dates = ['deleted_at'];

    public static function getTargetStores($id)
    {
        $urgentnotice = UrgentNotice::find($id);

        if(isset($urgentnotice->all_stores) && $urgentnotice->all_stores){
            $banner = $urgentnotice->banner_id;
            $stores = Banner::getStoreDetailsByBannerid($banner)->pluck('store_id')->toArray();
        }
        else{
            $stores = UrgentNoticeTarget::where('urgent_notice_id', $id)
                                            ->get()
                                            ->pluck('store_id')
                                            ->toArray();    
        }

        return $stores;
        
                                            
    }
}
