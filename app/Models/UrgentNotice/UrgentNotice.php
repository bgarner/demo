<?php

namespace App\Models\UrgentNotice;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use App\Models\Communication\Communication;
use DB;
use App\Models\Utility\Utility;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Validation\UrgentNoticeValidator;
use App\Models\UserSelectedBanner;


class UrgentNotice extends Model
{
    use SoftDeletes;
    protected $table = 'urgent_notices';
    protected $fillable = ['banner_id', 'title', 'description', 'attachment_type_id', 'start', 'end'];
    protected $dates = ['deleted_at'];

    public static function validateUrgentNotice($request)
    { 
      $validateThis = [ 
                        'title'         => $request['title'],
                        'start'         => $request['start'],
                        'end'           => $request['end'],
                        'target_stores' => $request['target_stores'],
                        'attachment_type_id' => $request['attachment_type'][0],
                        'folder'        => '',
                        'document'      => '',

                      ];
      if ($request['allStores'] != NULL) {
        $validateThis['allStores'] = $request['allStores'];
      }
      
      if($request['attachment_type'][0] == 1){
        $validateThis['folder'] = $request['attachments'][0];
      }
      if($request['attachment_type'][0] == 2){
        $validateThis['document'] = $request['attachments'][0];
      }
      
      \Log::info('*********');
      \Log::info($validateThis);
      \Log::info('*********');
      
      $v = new UrgentNoticeValidator();
      $validationResult =  $v->validate($validateThis);
      \Log::info($validationResult);
      return $validationResult;
       
    }


    public static function storeUrgentNotice(Request $request)
    {
    	\Log::info($request->all());
    	$validate = UrgentNotice::validateUrgentNotice($request);
        if($validate['validation_result'] == 'false') {
          return json_encode($validate);
        }

        $banner = UserSelectedBanner::getBanner();
    	$title = $request->title;
    	$description = $request->description;
    	$start = $request->start;
    	$end = $request->end;
    	$attachment_type_id = $request->attachment_type;
    	$attachments = $request->attachments;
    	$target_stores = $request->target_stores;
    	
    	
    	$urgentNotice = UrgentNotice::create([
    		'banner_id' => $banner->id,
    		'title'		=> $title,
    		'description' => $description,
    		'start'		=> $start,
    		'end'		=> $end,
    		'attachment_type_id'=>$attachment_type_id
    	]);

    	if($attachment_type_id != 3){
            foreach ($attachments as $attachment) {
                UrgentNoticeAttachment::create([
                    'urgent_notice_id' => $urgentNotice->id,
                    'attachment_id' => $attachment
                ]);
            }    
        }
        

    	foreach ($target_stores as $store) {
    		UrgentNoticeTarget::create([
    			'urgent_notice_id' 	=> $urgentNotice->id,
    			'store_id'			=> $store
    		]);
    	}
    	return $urgentNotice;
    	
    }

    public static function updateUrgentNotice($request, $id)
    {
    	\Log::info($request->all());
        \Log::info(gettype($request['target_stores']));
        $validate = UrgentNotice::validateUrgentNotice($request);
        if($validate['validation_result'] == 'false') {
          \Log::info($validate);
          return json_encode($validate);
        }

        $urgentNotice = UrgentNotice::find($id);
        $attachment_type_id = $urgentNotice->attachment_type_id;


        $banner_id = $request->banner_id;
    	$title = $request->title;
    	$description = $request->description;
    	$start = $request->start;
    	$end = $request->end;	
    	$new_attachments = $request->new_attachments;
        $remove_attachments = $request->remove_attachments;
    	$target_stores = $request->target_stores;
        
        
        $new_attachment_type_id = intval($request->new_attachment_type);
        
        if($new_attachment_type_id != 3) {
            if ($new_attachment_type_id != $attachment_type_id) {
                $attachment_type_id = $new_attachment_type_id;
                UrgentNoticeAttachment::where('urgent_notice_id', $id)->delete();
            }
        }
        
        else{
            if(isset($remove_attachments)) {
                foreach ($remove_attachments as $attachment) {
                UrgentNoticeAttachment::where('urgent_notice_id', $id)->where('attachment_id', $attachment)->delete();
                } 
            }
            
        } 
        
    	
    	$urgentNotice->update([
    		'banner_id' => $banner_id,
    		'title'		=> $title,
    		'description' => $description,
    		'start'		=> $start,
    		'end'		=> $end,
    		'attachment_type_id'	=> $attachment_type_id
    	]);
    	$urgentNotice->save();

    	
    	if (isset($new_attachments)) {
            foreach ($new_attachments as $attachment) {
            UrgentNoticeAttachment::create([
                'urgent_notice_id' => $urgentNotice->id,
                'attachment_id' => $attachment
            ]);
        }
        }
        
        if (isset($request['target_stores']) && $request['target_stores'] != '' ) {
            UrgentNoticeTarget::where('urgent_notice_id', $id)->delete();
            foreach ($target_stores as $store) {
                UrgentNoticeTarget::create([
                    'urgent_notice_id'  => $urgentNotice->id,
                    'store_id'          => $store
                ]);
            }
        }
    	
        return $urgentNotice;

    }

    public static function deleteUrgentNotice($id)
    {
        UrgentNotice::find($id)->delete();
        UrgentNoticeTarget::where('urgent_notice_id', $id)->delete();
        UrgentNoticeAttachment::where('urgent_notice_id', $id)->delete();
    }

    public static function getUrgentNoticeCount($storeNumber)
    {
         $now = Carbon::now()->toDatetimeString();
 
        return UrgentNoticeTarget::join('urgent_notices', 'urgent_notices.id' , '=', 'urgent_notice_target.urgent_notice_id')
                                ->where('urgent_notice_target.store_id', $storeNumber)
                                ->where('urgent_notice_target.is_read', 0)
                                ->where('urgent_notices.start' , '<=', $now)
                                ->where('urgent_notices.end', '>=', $now)
                                ->count();
    }

    public static function getUrgentNotice($id)
    {    
         $notice = UrgentNotice::find($id);
         $notice->prettyDate = Utility::prettifyDate($notice->start);
         $notice->since = Utility::getTimePastSinceDate($notice->start);
         return $notice;
    }


    public static function getActiveUrgentNoticesByStore($storeNumber)
    {
        
        $now = Carbon::now()->toDatetimeString();

        $notices = UrgentNoticeTarget::join('urgent_notices', 'urgent_notices.id' , '=', 'urgent_notice_target.urgent_notice_id')
                                ->where('urgent_notice_target.store_id', $storeNumber)
                                ->where('urgent_notices.start' , '<=', $now)
                                ->where('urgent_notices.end', '>=', $now)
                                ->select('urgent_notices.*')
                                ->get();
                        
        foreach($notices as $n){
            
            $n->since =  Utility::getTimePastSinceDate($n->start);
            $n->prettyDate =  Utility::prettifyDate($n->start);
            $preview_string = strip_tags($n->description);
            $n->trunc = Communication::truncateHtml($preview_string);
        }

        return $notices;        

    }   

    public static function getArchivedUrgentNoticesByStore($storeNumber)
    {
        $now = Carbon::now()->toDatetimeString();

        $notices = DB::table('urgent_notice_target')->where('store_id', $storeNumber)
                            ->join('urgent_notices', 'urgent_notices.id', '=', 'urgent_notice_target.urgent_notice_id')
                            ->where('urgent_notices.end' , '<=', $now)
                            ->get();

        foreach($notices as $n){
            $n->archived= true;
            $n->since =  Utility::getTimePastSinceDate($n->start);
            $n->prettyDate =  Utility::prettifyDate($n->start);
            $preview_string = strip_tags($n->description);
            $n->trunc = Communication::truncateHtml($preview_string);
        }
        return $notices;        

    }


}
