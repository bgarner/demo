<?php

use Illuminate\Database\Seeder;

class DistrictTableSeeder extends Seeder
{
    private $districts = [

	    ["name" => 'Atlantic Canada', "dm_name" => 'Dave Dekkers'],
		["name" => 'Maritimes', "dm_name" => "Scott Allen"],
		["name" => 'Ottawa', "dm_name" => "Derek Grange"],
		["name" => 'Ontario Southwest', "dm_name" => "Ken Van de Wal"],
		["name" => 'Ontario Southeast', "dm_name" => "Chris Braund"],
		["name" => 'GTA Southwest', "dm_name" => "Jim Phillip"],
		["name" => 'GTA East', "dm_name" => "Krista Selfridge"],
		["name" => 'GTA South', "dm_name" => "Mark Ehrlick"],
		["name" => 'GTA North', "dm_name" => "Greg Kotsopoulos"],
		["name" => 'GTA Northwest', "dm_name" => "Jayson McColgan"],
		["name" => 'Ontario East', "dm_name" => "Bob Legomski"],

		["name" => 'Atmosphere Prairies', "dm_name" => "Rob Conway"],
		["name" => 'Atmosphere BC', "dm_name" => "Mike Friesen"],
		["name" => 'Manitoba', "dm_name" => "Gord Bergen"],
		["name" => 'Saskatchewan',"dm_name" => "Brandon McEachern"],
		["name" => 'Edmonton West', "dm_name" => "Grant Ranger"],
		["name" => 'Edmonton East', "dm_name" => "Ashley Baye"],
		["name" => 'Calgary South', "dm_name" => "Curtis Joly"],
		["name" => 'Calgary North', "dm_name" => "Will Lauber"],
		["name" => 'GVA Interior', "dm_name" => "Howard Toering"],
		["name" => 'GVA Island', "dm_name" => "Chris Owen"],
		["name" => 'GVA North', "dm_name" => "Lisa Salewski"]


    ];
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach($this->districts as $district)
        {
        	DB::table('districts')->insert($district);
        } 
    }
}
