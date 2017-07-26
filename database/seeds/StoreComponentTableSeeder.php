<?php

use Illuminate\Database\Seeder;

class StoreComponentTableSeeder extends Seeder
{
    private $components = [

		['id' => 1, 'component_name' => 'Urgent Notice',  'component_label'  => 'URGENT NOTICE', 'banner_id'  => 1],
		['id' => 2, 'component_name' => 'Dashboard',  	  'component_label'  => 'Dashboard',  	 'banner_id'  => 1],
		['id' => 3, 'component_name' => 'Calendar',  	  'component_label'	 => 'Calendar', 	 'banner_id'  => 1],
		['id' => 4, 'component_name' => 'Communications', 'component_label'  => 'Communications','banner_id'  => 1],
		['id' => 5, 'component_name' => 'Alerts',  		  'component_label'  => 'Alerts', 		 'banner_id'  => 1],
		['id' => 6, 'component_name' => 'Tasks',  		  'component_label'  => 'Tasks', 		 'banner_id'  => 1],
		['id' => 7, 'component_name' => 'Flyer',  		  'component_label'  => 'Flyer', 		 'banner_id'  => 1],
		['id' => 8, 'component_name' => 'Library',  	  'component_label'  => 'Library', 		 'banner_id'  => 1],
		['id' => 9, 'component_name' => 'Video Library',  'component_label'  => 'Video Library', 'banner_id'  => 1],
		['id' => 10,'component_name' => 'Community',  	  'component_label'  => 'Community', 	 'banner_id'  => 1],
		['id' => 11,'component_name' => 'Tools',  		  'component_label'  => 'Tools', 		 'banner_id'  => 1],

		['id' => 12,'component_name' => 'Urgent Notice',  'component_label'  => 'URGENT NOTICE', 'banner_id'  => 2],
		['id' => 13,'component_name' => 'Dashboard',  	  'component_label'  => 'Dashboard',  	 'banner_id'  => 2],
		['id' => 14,'component_name' => 'Calendar',  	  'component_label'	 => 'Calendar', 	 'banner_id'  => 2],
		['id' => 15,'component_name' => 'Communications', 'component_label'  => 'Communications','banner_id'  => 2],
		['id' => 16,'component_name' => 'Alerts',  		  'component_label'  => 'Alerts', 		 'banner_id'  => 2],
		['id' => 17,'component_name' => 'Tasks',  		  'component_label'  => 'Tasks', 		 'banner_id'  => 2],
		['id' => 18,'component_name' => 'Flyer',  		  'component_label'  => 'Flyer', 		 'banner_id'  => 2],
		['id' => 19,'component_name' => 'Library',  	  'component_label'  => 'Library', 		 'banner_id'  => 2],
		['id' => 20,'component_name' => 'Video Library',  'component_label'  => 'Video Library', 'banner_id'  => 2],
		['id' => 21,'component_name' => 'Community',  	  'component_label'  => 'Community', 	 'banner_id'  => 2],
		['id' => 22,'component_name' => 'Tools',  		  'component_label'  => 'Tools', 		 'banner_id'  => 2],
        
    ];
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach ($this->components as $component) {
        	DB::table('store_components')->insert($component);
        }
    }
}
