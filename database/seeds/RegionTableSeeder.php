<?php

use Illuminate\Database\Seeder;

class RegionTableSeeder extends Seeder
{
    private $regions = [
    	['name' => 'East', 'avp_name'=>'Jason Morris' ],
    	['name' => 'East', 'avp_name' => 'Matt Lappin-Fortin'],
    	['name' => 'West', 'avp_name' => 'Dax Brewster' ],
    	['name' => 'West', 'avp_name' => 'Michael Poelzer' ]
    ];

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach ($this->regions as $region) {
        	DB::table('regions')->insert($region);
        }
    }
}
