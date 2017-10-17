<?php

use Illuminate\Database\Seeder;
use App\Models\Communication\CommunicationType;
use App\Models\Communication\Communication;

class CommunicationTypeBannerTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // separate out banner info from communication_types table into communication_type_banner_table
        $comm_types = CommunicationType::get();

        foreach ($comm_types as $type) {

        	if($type->banner_id == 1){
        		\DB::table('communication_type_banner')->insert([
        			'communication_type_id' => $type->id,
        			'banner_id' => $type->banner_id
        		]);	
        	}

        	if($type->banner_id == 2){
        		$correspondingSCType = CommunicationType::where('banner_id', 1)
					        			->where('communication_type', $type->communication_type)
					        			->first();
				if(!$correspondingSCType){
					\DB::table('communication_type_banner')->insert([
	        			'communication_type_id' => $type->id,
	        			'banner_id' => $type->banner_id
	        		]);						
				}
                else{
                    \DB::table('communication_type_banner')->insert([
                        'communication_type_id' => $correspondingSCType->id,
                        'banner_id' => $type->banner_id
                    ]); 
                }

				

        	}
        	
        }

    //     //replace Atmo communication_type_id with corresponding SC communication_type_id

        $communications = Communication::where('banner_id', 2)->get();

        foreach ($communications as $comm) {
            $type_id = $comm->communication_type_id; 
            $communication_type = CommunicationType::find($type_id)->communication_type;
            $correspondingSCType = CommunicationType::where('communication_type', $communication_type)
                                 ->where('banner_id', 1)
                                 ->first();
            if($correspondingSCType){
                $comm->communication_type_id = $correspondingSCType->id;
                $comm->save();
            }
            else{

            }
            
        }


    //     //separate out banner info from communications table into communication_banner table

        $communications = Communication::get();

        foreach ($communications as $comm) {

            \DB::table('communication_banner')->insert([
                'communication_id' => $comm->id,
                'banner_id' => $comm->banner_id
            ]);
            
        }

        //remove communication types with banner_id == 2 (already mapped to corresponding SC ids in communication_type_banner table)

        CommunicationType::where('banner_id', 2)->delete();



    }
}
