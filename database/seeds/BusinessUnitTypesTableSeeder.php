<?php

use Illuminate\Database\Seeder;
use App\Models\Form\ProductRequest\BusinessUnitTypes;

class BusinessUnitTypesTableSeeder extends Seeder
{
    
	private $businessUnits = [ 'Hardgoods', 'Softgoods', 'Footwear' ];
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach ($this->businessUnits as $bu) {
        	BusinessUnitTypes::create([
        		'business_unit' => $bu
        	]);
        }
    }
}
