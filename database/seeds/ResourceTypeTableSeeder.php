<?php

use Illuminate\Database\Seeder;

class ResourceTypeTableSeeder extends Seeder
{
    private $resourceTypes = [
    	['id' => 1, 'resource_name' => 'store' ],
    	['id' => 2, 'resource_name' => 'district' ],
    	['id' => 3, 'resource_name' => 'region' ],
        ['id' => 4, 'resource_name' => 'regions' ]

    ];
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach ($this->resourceTypes as $resourceType) {
        	DB::table('resource_types')->insert($resourceType);
        }
    }
}
