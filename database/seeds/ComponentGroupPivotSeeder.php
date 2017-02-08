<?php

use Illuminate\Database\Seeder;

class ComponentGroupPivotSeeder extends Seeder
{
    private $components = [

    	['component_id' => 1 , 'group_id' => 1],
        ['component_id' => 2 , 'group_id' => 1],
        ['component_id' => 3 , 'group_id' => 1],
        ['component_id' => 4 , 'group_id' => 1],
        ['component_id' => 5 , 'group_id' => 1],
        ['component_id' => 6 , 'group_id' => 1],
        ['component_id' => 7 , 'group_id' => 1],
        ['component_id' => 8 , 'group_id' => 1],
        ['component_id' => 9 , 'group_id' => 1],
        ['component_id' => 1 , 'group_id' => 2],
        ['component_id' => 2 , 'group_id' => 2],
        ['component_id' => 3 , 'group_id' => 2],
        ['component_id' => 4 , 'group_id' => 2],
        ['component_id' => 5 , 'group_id' => 2],
        ['component_id' => 6 , 'group_id' => 2],
        ['component_id' => 7 , 'group_id' => 2],
    ];

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach ($this->components as $component) {
        	DB::table('group_component')->insert($component);
        }
    }
}
