<?php

use Illuminate\Database\Seeder;

class DistrictTableSeeder extends Seeder
{
    private $districts = [
		["id" => 1, "name" => "Maritimes"],
		["id" => 2, "name" => "Atlantic Canada"],
		["id" => 3, "name" => "Ottawa"],
		["id" => 4, "name" => "GTA North"],
		["id" => 5, "name" => "Ontario North"],
		["id" => 6, "name" => "Ontario East"],
		["id" => 7, "name" => "Ontario Southwest"],
		["id" => 8, "name" => "Ontario Southeast"],
		["id" => 9, "name" => "Ontario West"],
		["id" => 10, "name" => "GTA Northwest"],
		["id" => 11, "name" => "GTA South"],
		["id" => 12, "name" => "GTA Southwest"],
		["id" => 13, "name" => "Edmonton West"],
		["id" => 14, "name" => "Edmonton East"],
		["id" => 15, "name" => "Saskatchewan"],
		["id" => 16, "name" => "Calgary South"],
		["id" => 17, "name" => "Calgary North"],
		["id" => 18, "name" => "Atmosphere Prairies"],
		["id" => 19, "name" => "Atmosphere B.C."],
		["id" => 20, "name" => "Manitoba"],
		["id" => 21, "name" => "GVA Island"],
		["id" => 22, "name" => "GVA North"],
		["id" => 23, "name" => "GVA Interior"]
    ];
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
		DB::table('districts')->truncate();

        foreach($this->districts as $district)
        {
        	DB::table('districts')->insert($district);
        } 
    }
}
