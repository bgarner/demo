<?php

use Illuminate\Database\Seeder;

class StoreComponentTableSeeder extends Seeder
{
    private $components = [

    	['id' =>1, 'component_name' =>'Home', 'banner_id' => 1],
        ['id' =>2, 'component_name' =>'Dashboard','banner_id' => 1],
        ['id' =>3, 'component_name' =>'Featured Content','banner_id' => 1],
        ['id' =>4, 'component_name' =>'Calendar','banner_id' => 1],
        ['id' =>5, 'component_name' =>'Communications','banner_id' => 1],
        ['id' =>6, 'component_name' =>'Library','banner_id' => 1],
        ['id' =>7, 'component_name' =>'Alerts and Notices' , 'banner_id' => 1],
        ['id' =>8, 'component_name' =>'Videos','banner_id' => 1],
        ['id' =>9, 'component_name' =>'Task Management','banner_id' => 1],
        ['id' =>10, 'component_name' =>'User and Group Management','banner_id' => 1],
        ['id' =>11, 'component_name' =>'Store Feedback Management','banner_id' => 1],
        ['id' =>1, 'component_name' =>'Home', 'banner_id' => 2],
        ['id' =>2, 'component_name' =>'Dashboard','banner_id' => 2],
        ['id' =>3, 'component_name' =>'Featured Content','banner_id' => 2],
        ['id' =>4, 'component_name' =>'Calendar','banner_id' => 2],
        ['id' =>5, 'component_name' =>'Communications','banner_id' => 2],
        ['id' =>6, 'component_name' =>'Library','banner_id' => 2],
        ['id' =>7, 'component_name' =>'Alerts and Notices' , 'banner_id' => 2],
        ['id' =>8, 'component_name' =>'Videos','banner_id' => 2],
        ['id' =>9, 'component_name' =>'Task Management','banner_id' => 2],
        ['id' =>10, 'component_name' =>'User and Group Management','banner_id' => 2],
        ['id' =>11, 'component_name' =>'Store Feedback Management','banner_id' => 2],
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
