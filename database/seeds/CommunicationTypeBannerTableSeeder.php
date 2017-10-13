<?php

use Illuminate\Database\Seeder;

class CommunicationTypeBannerTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $comm_types = \DB::table('communication_types')->get();
        foreach ($comm_types as $type) {

        	if($type->banner_id == 1){
        		\DB::table('communication_type_banner')->insert([
        			'communication_type_id' => $type->id,
        			'banner_id' => $type->banner_id
        		]);	
        	}

        	if($type->banner_id == 2){
        		$correspondingSCType = \DB::table('communication_types')
					        			->where('communication_type', $type->communication_type)
					        			->where('banner_id', 1)
					        			->first();
				if(!$correspondingSCType){
					\DB::table('communication_type_banner')->insert([
	        			'communication_type_id' => $type->id,
	        			'banner_id' => $type->banner_id
	        		]);						
				}

				\DB::table('communication_type_banner')->insert([
        			'communication_type_id' => $correspondingSCType->id,
        			'banner_id' => $type->banner_id
        		]);	

        	}
        	
        }
    }
}
