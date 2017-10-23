<?php

use Illuminate\Database\Seeder;
use App\Models\Event\EventType;
use App\Models\Event\Event;

class EventTypeBannerTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
		// separate out banner info from event_types table into event_type_banner_table
        $event_types = EventType::get();

        foreach ($event_types as $type) {

        	if($type->banner_id == 1){
        		\DB::table('event_type_banner')->insert([
        			'event_type_id' => $type->id,
        			'banner_id' => $type->banner_id
        		]);	
        	}

        	if($type->banner_id == 2){
        		$correspondingSCType = EventType::where('banner_id', 1)
					        			->where('event_type', $type->event_type)
					        			->first();
				if(!$correspondingSCType){
					\DB::table('event_type_banner')->insert([
	        			'event_type_id' => $type->id,
	        			'banner_id' => $type->banner_id
	        		]);						
				}
                else{
                    \DB::table('event_type_banner')->insert([
                        'event_type_id' => $correspondingSCType->id,
                        'banner_id' => $type->banner_id
                    ]); 
                }		

        	}
        	
        }

        //replace Atmo event_type with corresponding SC event_type

        $events = Event::where('banner_id', 2)->get();

        foreach ($events as $event) {
            $type_id = $event->event_type; 
            $event_type = EventType::find($type_id)->event_type;
            $correspondingSCType = EventType::where('event_type', $event_type)
                                 ->where('banner_id', 1)
                                 ->first();
            if($correspondingSCType){
                $event->event_type = $correspondingSCType->id;
                $event->save();
            }
            else{

            }
            
        }

        //separate out banner info from events table into event_banner table

        $events = Event::get();

        foreach ($events as $event) {

            \DB::table('event_banner')->insert([
                'event_id' => $event->id,
                'banner_id' => $event->banner_id
            ]);
            
        }

        //remove communication types with banner_id == 2 (already mapped to corresponding SC ids in communication_type_banner table)
        $eventTypes = EventType::where('banner_id', 2)->get();

        foreach ($eventTypes as $type) {
            $correspondingSCType = EventType::where('event_type', $type->event_type)
                                 ->where('banner_id', 1)
                                 ->first();
            if($correspondingSCType){
                $type->delete();        
            }
        }

        
    }
}
