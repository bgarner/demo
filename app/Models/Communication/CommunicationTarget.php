<?php

namespace App\Models\Communication;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Carbon\Carbon;
use DB; 
use App\Models\Utility\Utility;
use App\Models\StoreInfo;
use App\Models\Communication\Communication;

class CommunicationTarget extends Model
{
	protected $table = 'communications_target';
	protected $fillable = ['communication_id', 'store_id', 'is_read'];

    public static function updateTargetStores($id, $request)
    {
        $target_stores = $request['target_stores'];
        $allStores = $request['all_stores'];
        if($allStores == 'on') {
            CommunicationTarget::where('communication_id', $id)->delete();
            $communication = Communication::find($id);
            $communication->all_stores = 1;
            $communication->save();
        }
        else{
            CommunicationTarget::where('communication_id', $id)->delete();
            if (count($target_stores) > 0) {
                foreach ($target_stores as $store) {
                    CommunicationTarget::create([
                        'communication_id' => $id,
                        'store_id'         => $store
                    ]);
                }

                Utility::addHeadOffice($id, 'communications_target', 'communication_id');
                
            } 
            $communication = Communication::find($id);
            $communication->all_stores = 0;
            $communication->save();
        }
         
        return;
    }

}
