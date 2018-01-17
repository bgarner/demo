<?php

use Illuminate\Database\Seeder;

class FeatureCommunicationTypeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $feature_comm_types = \DB::table('communication_types_features')->get();
        foreach ($feature_comm_types as $relation) {
        	\DB::table('feature_communication_types')->insert([
        			'feature_id' => $relation->feature_id,
        			'communication_type_id' => $relation->communication_type_id,
        		]);
        }
    }
}
