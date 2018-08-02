<?php

use Illuminate\Database\Seeder;

class StoreSubComponentsTableSeeder extends Seeder
{
    private $components = [
		
		[
			'id' => 1, 
			'parent_component_id' => 3, 
			'subcomponent_name' => 'Calendar', 
			'subcomponent_label'	 => 'Calendar', 	 
			'banner_id'  => 1
		],
		[
			'id' => 2, 
			'parent_component_id' => 3, 
			'subcomponent_name' => 'Product Launch', 
			'subcomponent_label'	 => 'Product Launch', 	 
			'banner_id'  => 1
		],
		
		[
			'id' => 3, 
			'parent_component_id' => 11, 
			'subcomponent_name' => 'DOM Flash Sale Tracker', 
			'subcomponent_label'  => 'DOM Flash Sale Tracker', 		 
			'banner_id'  => 1
		],
		[
			'id' => 4, 
			'parent_component_id' => 11, 
			'subcomponent_name' => 'Dirty Nodes', 
			'subcomponent_label'  => 'Dirty Nodes', 		 
			'banner_id'  => 1
		],
		[
			'id' => 5, 
			'parent_component_id' => 11, 
			'subcomponent_name' => 'Aged Inventory', 
			'subcomponent_label'  => 'Aged Inventory', 		 
			'banner_id'  => 1
		],
		[
			'id' => 6, 
			'parent_component_id' => 11, 
			'subcomponent_name' => 'Product Deliveries', 
			'subcomponent_label'  => 'Product Deliveries', 		 
			'banner_id'  => 1
		],
		[
			'id' => 7, 
			'parent_component_id' => 3, 
			'subcomponent_name' => 'Calendar', 
			'subcomponent_label'	 => 'Calendar', 	 
			'banner_id'  => 2
		],
		[
			'id' => 8, 
			'parent_component_id' => 3, 
			'subcomponent_name' => 'Product Launch', 
			'subcomponent_label'	 => 'Product Launch', 	 
			'banner_id'  => 2
		],
		
		[
			'id' => 9, 
			'parent_component_id' => 11, 
			'subcomponent_name' => 'DOM Flash Sale Tracker', 
			'subcomponent_label'  => 'DOM Flash Sale Tracker', 		 
			'banner_id'  => 2
		],
		[
			'id' => 10, 
			'parent_component_id' => 11, 
			'subcomponent_name' => 'Dirty Nodes', 
			'subcomponent_label'  => 'Dirty Nodes', 		 
			'banner_id'  => 2
		],
		[
			'id' => 11, 
			'parent_component_id' => 11, 
			'subcomponent_name' => 'Aged Inventory', 
			'subcomponent_label'  => 'Aged Inventory', 		 
			'banner_id'  => 2
		],
		[
			'id' => 12, 
			'parent_component_id' => 11, 
			'subcomponent_name' => 'Product Deliveries', 
			'subcomponent_label'  => 'Product Deliveries', 		 
			'banner_id'  => 2
		],

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
        	$row = DB::table('store_components_subcomponents')->insert($component);

        }
    }
}
