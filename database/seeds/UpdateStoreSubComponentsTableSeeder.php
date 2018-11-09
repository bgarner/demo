<?php

use Illuminate\Database\Seeder;

class UpdateStoreSubComponentsTableSeeder extends Seeder
{
    private $components = [
        
        [
            'id' => 13, 
            'parent_component_id' => 11, 
            'subcomponent_name' => 'Doorcrasher Tracker', 
            'subcomponent_label'     => 'Doorcrasher Tracker',      
            'banner_id'  => 1
        ],
        [
            'id' => 14, 
            'parent_component_id' => 22, 
            'subcomponent_name' => 'Doorcrasher Tracker', 
            'subcomponent_label'     => 'Doorcrasher Tracker',      
            'banner_id'  => 2
        ]
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
