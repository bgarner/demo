<?php

use Illuminate\Database\Seeder;

class ComponentsTableSeeder extends Seeder
{
    private $components = [

    	['component_name' =>'Home', 'banner_id' => 1],
        ['component_name' =>'Dashboard','banner_id' => 1],
        ['component_name' =>'Featured Content','banner_id' => 1],
        ['component_name' =>'Calendar','banner_id' => 1],
        ['component_name' =>'Communications','banner_id' => 1],
        ['component_name' =>'Library','banner_id' => 1],
        ['component_name' =>'Alerts and Notices' , 'banner_id' => 1],
        ['component_name' =>'Videos','banner_id' => 1],
        ['component_name' =>'User and Group Management','banner_id' => 1],
        ['component_name' =>'Store Feedback Management','banner_id' => 1],
    ];
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach ($this->components as $component) {
        	DB::table('components')->insert($component);
        }
    }
}
