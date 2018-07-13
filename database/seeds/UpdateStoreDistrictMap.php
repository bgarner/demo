<?php

use Illuminate\Database\Seeder;

class UpdateStoreDistrictMap extends Seeder
{
    
    private $store_districts = [
    	['store_id' => '0257', 'district_id' => '8'],
    	['store_id' => '0352', 'district_id' => '8'],
    	['store_id' => '5131', 'district_id' => '9'],
    	['store_id' => '0375', 'district_id' => '12'],
    	['store_id' => '0294', 'district_id' => '12'],
    	['store_id' => '5150', 'district_id' => '23'],


    ];
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach($this->store_districts as $sd)
        {
        	$map = \DB::table('district_store')->where('store_id', $sd['store_id'])->update(['district_id' => $sd['district_id']]);
        }
    }
}
