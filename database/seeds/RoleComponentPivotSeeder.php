<?php

use Illuminate\Database\Seeder;

class RoleComponentPivotSeeder extends Seeder
{
    private $components = [

    	['component_id' => 1 , 'role_id' => 1],
        ['component_id' => 2 , 'role_id' => 1],
        ['component_id' => 3 , 'role_id' => 1],
        ['component_id' => 4 , 'role_id' => 1],
        ['component_id' => 5 , 'role_id' => 1],
        ['component_id' => 6 , 'role_id' => 1],
        ['component_id' => 7 , 'role_id' => 1],
        ['component_id' => 8 , 'role_id' => 1],
        ['component_id' => 9 , 'role_id' => 1],
        ['component_id' => 10 , 'role_id' => 1],
        ['component_id' => 11 , 'role_id' => 1],
        ['component_id' => 1 , 'role_id' => 2],
        ['component_id' => 2 , 'role_id' => 2],
        ['component_id' => 3 , 'role_id' => 2],
        ['component_id' => 4 , 'role_id' => 2],
        ['component_id' => 5 , 'role_id' => 2],
        ['component_id' => 6 , 'role_id' => 2],
        ['component_id' => 7 , 'role_id' => 2],
        ['component_id' => 8 , 'role_id' => 2],
        ['component_id' => 9 , 'role_id' => 2],
        ['component_id' => 1 , 'role_id' => 3],
        ['component_id' => 8 , 'role_id' => 3],
    ];

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach ($this->components as $component) {
        	DB::table('role_component')->insert($component);
        }
    }
}
