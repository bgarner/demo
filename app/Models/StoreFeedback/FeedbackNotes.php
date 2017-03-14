<?php

namespace App\Models\StoreFeedback;

use Illuminate\Database\Eloquent\Model;
use App\Models\Utility\Utility;

class FeedbackNotes extends Model
{
    protected $table = 'feedback_notes';

    protected $fillable = ['feedback_id', 'note'];
    
    public static function getFeedbackNotesByFeedbackId($id)
    {
    	$notes =  FeedbackNotes::where('feedback_id', $id)
    						->get()
    						->each(function($note){
    							$note->prettyStartDate = Utility::prettifyDate($note->created_at);
    							$note->prettyUpdateDate = Utility::prettifyDate($note->updated_at);
    							$note->displayDate = $note->created_at;
    							$note->displayText = 'Added at:';
    							if($note->updated_at > $note->created_at)
    							{
    								$note->displayDate = $note->created_at;
    								$note->displayText = 'Updated at:';
    							}
    							$note->prettyDisplayDate = Utility::prettifyDate($note->displayDate);
    						})
    						->sortByDesc('displayDate');
    	return $notes;
    }

    public static function addFeedbackNote($feedbackId, $note)
    {
        FeedbackNotes::create([
            'feedback_id' => $feedbackId,
            'note'         => $note
        ]);
    }

    public static function editFeedbackNote($request)
    {
        \Log::info($request->all());
        $feedbackId = $request['feedback_id'];
        $note = $request['note'];
        $noteId = $request['note_id'];
        $feedbackNote = FeedbackNotes::where('feedback_id', $feedbackId)->where('id', $noteId)->first();
        $feedbackNote->note = $note;
        $feedbackNote->save();
        return;
    }
}
