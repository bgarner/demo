<?php

use Illuminate\Database\Seeder;

class MarksRegionTableSeeder extends Seeder
{
    private $regions = [
    	['name' => 'BC', 'avp_name'=>''],
    	['name' => 'AB/SK', 'avp_name' => ''],
    	['name' => 'ONTSW/NORTH', 'avp_name' => ''],
        ['name' => 'SEONT/MAN', 'avp_name' => ''],
        ['name' => 'QUEBEC', 'avp_name' => ''],
        ['name' => 'ATLANTIC', 'avp_name' => ''],
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