<?php

namespace App\Models\Analytics;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class AnalyticsCollection extends Model
{
    protected $table = 'analytics_collection';
    protected $fillable = ['resource_id', 'asset_type_id', 'opened_total', 'unopened_total', 'sent_to_total', 'opened', 'unopened', 'sent_to'];

    public static function getActiveCommunicationStats()
    {
    	return AnalyticsCollection::join('communications', 'communications.id', '=', 'analytics_collection.resource_id' )
    							->join('communication_types', 'communication_types.id', '=', 'communications.communication_type_id')
    							->where('asset_type_id', 1)
    							->where('communications.send_at', '>=', Carbon::now()->subDays(120))
    							->select('communications.*', 'communication_types.communication_type', 'communication_types.colour', 'analytics_collection.opened_total', 'analytics_collection.unopened_total', 'analytics_collection.sent_to_total', 
    								'analytics_collection.opened', 'analytics_collection.unopened', 'analytics_collection.sent_to'
    							 )
    							->get()
    							->sortByDesc('communications.send_at')
    							->each(function($item){
    								$item->readPerc = round (($item->opened_total/$item->sent_to_total)*100);
    								$item->opened = json_encode(unserialize($item->opened));
    								$item->unopened = json_encode(unserialize($item->unopened));
    								$item->sent_to = json_encode(unserialize($item->sent_to));
    							});


    }

    public static function getActiveUrgentNoticeStats()
    {
    	return AnalyticsCollection::join('urgent_notices', 'urgent_notices.id', '=', 'analytics_collection.resource_id' )
    							->where('asset_type_id', 3)
    							->where('urgent_notices.start', '>=', Carbon::now()->subDays(120))
    							->select('urgent_notices.*', 'analytics_collection.opened_total', 'analytics_collection.unopened_total', 'analytics_collection.sent_to_total', 
    								'analytics_collection.opened', 'analytics_collection.unopened', 'analytics_collection.sent_to'
    							 )
    							->get()
    							->sortByDesc('urgent_notices.start')
    							->each(function($item){
    								$item->readPerc = round (($item->opened_total/$item->sent_to_total)*100);
    								$item->opened = json_encode(unserialize($item->opened));
    								$item->unopened = json_encode(unserialize($item->unopened));
    								$item->sent_to = json_encode(unserialize($item->sent_to));
    							});


    }

    public static function getTaskStats()
    {
    	
    	return AnalyticsCollection::join('tasks', 'tasks.id', '=', 'analytics_collection.resource_id' )
    							->where('asset_type_id', 4)
    							->select('tasks.*', 'analytics_collection.opened_total', 'analytics_collection.unopened_total', 'analytics_collection.sent_to_total', 
    								'analytics_collection.opened', 'analytics_collection.unopened', 'analytics_collection.sent_to'
    							 )
    							->get()
    							->each(function($item){
    								$item->readPerc = round (($item->opened_total/$item->sent_to_total)*100);
    								$item->opened = json_encode(unserialize($item->opened));
    								$item->unopened = json_encode(unserialize($item->unopened));
    								$item->sent_to = json_encode(unserialize($item->sent_to));
    							});
    	
    }

    public static function getVideoStats()
    {
    	
    	return AnalyticsCollection::join('videos', 'videos.id', '=', 'analytics_collection.resource_id' )
    							->where('asset_type_id', 5)
    							->select('videos.*', 'analytics_collection.opened_total', 'analytics_collection.unopened_total', 'analytics_collection.sent_to_total', 
    								'analytics_collection.opened', 'analytics_collection.unopened', 'analytics_collection.sent_to'
    							 )
    							->get()
    							->each(function($item){
    								$item->readPerc = round (($item->opened_total/$item->sent_to_total)*100);
    								$item->opened = json_encode(unserialize($item->opened));
    								$item->unopened = json_encode(unserialize($item->unopened));
    								$item->sent_to = json_encode(unserialize($item->sent_to));
    							});
    	
    }


}