<?php

use Illuminate\Database\Seeder;

class UpdateStoreComponentsTableSeeder extends Seeder
{
    private $components = [

	    ['id' => 23,'component_name' => 'Forms',  	  'component_label'  => 'Forms', 	 'banner_id'  => 1],
		['id' => 24,'component_name' => 'Forms',  		  'component_label'  => 'Forms', 		 'banner_id'  => 2],

	];

	/**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach ($this->components as $component) {
        	$component['config'] = json_encode(['state' => 'on']);
        	$row = DB::table('store_components')->insert($component);

        }
    }
}
