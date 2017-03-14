<?php

namespace App\Models\StoreFeedback;

use Illuminate\Database\Eloquent\Model;
use App\Models\StoreFeedback\FeedbackNotes;
use App\Models\StoreFeedback\FeedbackCategoryTypes;
use App\Models\StoreFeedback\FeedbackStatusTypes;

class FeedbackResponse extends Model
{
    protected $table = 'feedback_response';

    protected $fillable = ['feedback_id', 'status_id', 'followed_up'];


    public static function getFeedbackResponse($feedback_id)
    {
    	return  FeedbackResponse::where('feedback_id', $feedback_id)->first();

    }

    public static function updateFeedbackResponse($feedbackId, $request)
    {
        if (isset($request['feedback_status_id'])) {

            $statusId = $request['feedback_status_id'];
            $status = FeedbackStatusTypes::find($statusId)->name;
            FeedbackResponse::updateFeedbackStatus($feedbackId, $statusId);
            FeedbackNotes::addFeedbackNote($feedbackId, 'Issue ' . $status);
            
        }

        if(isset($request['feedback_category_id'])){
            
            $categoyId = $request['feedback_category_id'];
            $category = FeedbackCategoryTypes::find($categoyId)->name;
            if (FeedbackCategory::where('feedback_id', '=', $feedbackId)->exists()) {
                
                FeedbackResponse::updateFeedbackCategory($feedbackId, $categoyId);
                FeedbackNotes::addFeedbackNote($feedbackId, 'Category updated to - "' . $category . '"');

            }
            else{

                FeedbackResponse::addFeedbackCategory($feedbackId, $categoyId);
                FeedbackResponse::updateFeedbackStatus($feedbackId, 1);
                FeedbackNotes::addFeedbackNote($feedbackId, 'New category assigned - "' . $category . '"');
                
            }
            
        }

        if(isset($request['feedback_follow_up'])){
            
            $response = FeedbackResponse::updateFeedbackFollowup($feedbackId, $request['feedback_follow_up']);
            if ($response) {
                if($request['feedback_follow_up']) {
                    FeedbackNotes::addFeedbackNote($feedbackId, 'Followed up with store');    
                }
                else{
                    FeedbackNotes::addFeedbackNote($feedbackId, 'Follow up cancelled');       
                }    
            }

        }
        
    }

    public static function updateFeedbackStatus($feedbackId, $statusId)
    {
        $feedbackResponse = FeedbackResponse::firstorNew(['feedback_id' => $feedbackId]);
        $feedbackResponse['feedback_status_id'] = intval( $statusId );
        $feedbackResponse->save();
    }

    public static function updateFeedbackCategory($feedbackId, $categoyId)
    {
        $feedbackCategory = FeedbackCategory::where('feedback_id' , $feedbackId)->first();
        $feedbackCategory['category_id'] = intval($categoyId);
        $feedbackCategory->save();
    }

    public static function addFeedbackCategory($feedbackId, $categoryId)
    {
        FeedbackCategory::create([
            'feedback_id' => $feedbackId ,
            'category_id' => intval($categoryId)
        ]);

    }
    public static function updateFeedbackFollowup($feedbackId, $followupStatus)
    {
        $feedbackResponse = FeedbackResponse::where(['feedback_id' => $feedbackId]);
        if ($feedbackResponse->exists()) {
            $feedbackResponseFirst = $feedbackResponse->first();
            $feedbackResponseFirst->followed_up = intval( $followupStatus );
            $feedbackResponseFirst->save();
            return true;
            
        }
        
    }

   

}
