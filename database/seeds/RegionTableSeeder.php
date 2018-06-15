<?php

use Illuminate\Database\Seeder;

class RegionTableSeeder extends Seeder
{
    private $regions = [
    	['name' => 'East - Maritimes', 'avp_name'=>'Jason Morris'],
    	['name' => 'East - Ontario', 'avp_name' => 'Stephen Tait'],
    	['name' => 'West - Alberta', 'avp_name' => 'Ashley Baye'],
    	['name' => 'West - BC', 'avp_name' => 'Michael Poelzer']
    ];

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('regions')->truncate();

        foreach ($this->regions as $region) {
        	DB::table('regions')->insert($region);
        }
    }
}
