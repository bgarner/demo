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
                        'communication_id'   => $id,
                        'store_id'   => $store
                    ]);
                }
            } 
            $communication = Communication::find($id);
            $communication->all_stores = 0;
            $communication->save();
        }
         
        return;
    }

    public static function getActiveCommunicationsByCategoryAndStoreNumber($storeNumber, $type_id)
    {
        $now = Carbon::now();

        $banner_id = StoreInfo::getStoreInfoByStoreId($storeNumber)->banner_id;

        $allStoreCommunications = Communication::where('all_stores', '=', 1)
                                            ->where('banner_id', $banner_id)
                                            ->where('communications.send_at' , '<=', $now)
                                            ->where('communications.archive_at', '>=', $now)
                                            ->where('communication_type_id', '=', $type_id)
                                            ->orderBy('send_at', 'desc')
                                            ->get();


        $targetedCommunications = CommunicationTarget::where('communications_target.store_id', '=', $storeNumber)
                        ->join('communications', 'communications_target.communication_id', '=', 'communications.id')
                        ->where('communications.send_at' , '<=', $now)
                        ->where('communications.archive_at', '>=', $now)
                        ->where('communications.communication_type_id', '=', $type_id)
                        ->orderBy('communications.send_at', 'desc')
                        ->get();

         $communications = $allStoreCommunications->merge($targetedCommunications)->each(function($c){
           
            $c->prettyDate = Utility::prettifyDate($c->send_at);
            $c->since = Utility::getTimePastSinceDate($c->send_at);
            $c->trunc = Communication::truncateHtml(strip_tags($c->body));
            $c->label_name = Communication::getCommunicationCategoryName($c->communication_type_id);
            $c->label_colour = Communication::getCommunicationCategoryColour($c->communication_type_id);
            $c->has_attachments = Communication::hasAttachments($c->id);

        });

        return $communications;
    }

}
