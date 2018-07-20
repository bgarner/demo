<?php

use Illuminate\Database\Seeder;

class MarksDistrictTableSeeder extends Seeder
{
    private $districts = [
		["id" => 1, "name" => "GVA"],
		["id" => 2, "name" => "BC North"],
		["id" => 3, "name" => "Vancouver Island"],
		["id" => 4, "name" => "Interior/Kootenay"],
		["id" => 5, "name" => "Okanagan"],
		["id" => 6, "name" => "Calgary Fort Mac"],
		["id" => 7, "name" => "Calgary/Southern AB"],
		["id" => 8, "name" => "Calgary North/Central Alberta"],
		["id" => 9, "name" => "Edmonton West"],
		["id" => 10, "name" => "Edmonton East"],
		["id" => 11, "name" => "Edmonton Central"],
		["id" => 12, "name" => "Sask North"],
		["id" => 13, "name" => "Sask South"],
		["id" => 14, "name" => "KW/Guelph"],
		["id" => 15, "name" => "Ontario North"],
		["id" => 16, "name" => "Georgian Bay South"],
		["id" => 17, "name" => "Ontario NW/South"],
		["id" => 18, "name" => "Central Ontario"],
		["id" => 19, "name" => "Hamilton/Niagra"],
		["id" => 20, "name" => "South West Ontario"],
		["id" => 21, "name" => "Manitoba"],
		["id" => 22, "name" => "Toronto N&E"],
        ["id" => 23, "name" => "Toronto Central/W"],
        ["id" => 24, "name" => "GTA East"],
        ["id" => 25, "name" => "Brampton/Burlington"],
        ["id" => 26, "name" => "Kingston & Region"],
        ["id" => 27, "name" => "Ottawa East"],
        ["id" => 28, "name" => "Ottawa West/Hvlands"],
        ["id" => 29, "name" => "Grand QC"],
        ["id" => 30, "name" => "Cantons Est/QCNord"],
        ["id" => 31, "name" => "Grand MTL Est"],
        ["id" => 32, "name" => "Grand MTL Ouest"],
        ["id" => 33, "name" => "Atlantic 1"],
        ["id" => 34, "name" => "Atlantic 2"],
        ["id" => 35, "name" => "Atlantic 3"]
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