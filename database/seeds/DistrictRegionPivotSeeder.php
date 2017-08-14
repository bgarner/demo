<?php

use Illuminate\Database\Seeder;

class DistrictRegionPivotSeeder extends Seeder
{
    private $districtRegions = [ 
    	["region_id" => 1, "district_id" =>	1], 
    	["region_id" => 1, "district_id" =>	2], 
    	["region_id" => 1, "district_id" =>	3], 
    	["region_id" => 2, "district_id" =>	4], 
    	["region_id" => 2, "district_id" =>	5], 
    	["region_id" => 2, "district_id" =>	6], 
    	["region_id" => 1, "district_id" =>	7], 
    	["region_id" => 2, "district_id" =>	8], 
    	["region_id" => 1, "district_id" =>	9], 
    	["region_id" => 2, "district_id" =>	10], 
    	["region_id" => 1, "district_id" =>	11],



    	["region_id" => 3, "district_id" => 12], 
    	["region_id" => 4, "district_id" => 13], 
    	["region_id" => 4, "district_id" => 14], 
    	["region_id" => 4, "district_id" => 15], 
    	["region_id" => 3, "district_id" => 16], 
    	["region_id" => 3, "district_id" => 17], 
    	["region_id" => 3, "district_id" => 18], 
    	["region_id" => 3, "district_id" => 19], 
    	["region_id" => 4, "district_id" => 20], 
    	["region_id" => 4, "district_id" => 21], 
    	["region_id" => 4, "district_id" => 22]

    ];
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach ($this->districtRegions as $value) {
        	DB::table('district_region')->insert($value);
        }
    }
}
