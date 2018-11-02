<?php

use Illuminate\Database\Seeder;

class UpdateStoreComponentsTableSeeder_V2 extends Seeder
{
    private $components = [

        [
            'id' => 25,
            'component_name' => 'Store Visit Report',
            'component_label'  => 'Store Visit Report',
            'banner_id'  => 1
        ],
        [
            'id' => 26,
            'component_name' => 'Store Visit Report',
            'component_label'  => 'Store Visit Report',
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
            $row = DB::table('store_components')->insert($component);

        }
    }
}
