<?php

use Illuminate\Database\Seeder;

class ResourcesTableSeeder extends Seeder
{
    private $resources = [
    	['resource_name' => 'district', 'resource_id' => '1' ],
    	['resource_name' => 'district', 'resource_id' => '2' ],
    	['resource_name' => 'district', 'resource_id' => '3' ],
    	['resource_name' => 'district', 'resource_id' => '4' ],
    	['resource_name' => 'district', 'resource_id' => '5' ],
    	['resource_name' => 'district', 'resource_id' => '6' ],
    	['resource_name' => 'district', 'resource_id' => '7' ],
    	['resource_name' => 'district', 'resource_id' => '8' ],
    	['resource_name' => 'district', 'resource_id' => '9' ],
    	['resource_name' => 'district', 'resource_id' => '10' ],
    	['resource_name' => 'district', 'resource_id' => '11' ],
    	['resource_name' => 'district', 'resource_id' => '12' ],
    	['resource_name' => 'district', 'resource_id' => '13' ],
    	['resource_name' => 'district', 'resource_id' => '14' ],
    	['resource_name' => 'district', 'resource_id' => '15' ],
    	['resource_name' => 'district', 'resource_id' => '16' ],
    	['resource_name' => 'district', 'resource_id' => '17' ],
    	['resource_name' => 'district', 'resource_id' => '18' ],
    	['resource_name' => 'district', 'resource_id' => '19' ],
    	['resource_name' => 'district', 'resource_id' => '20' ],
    	['resource_name' => 'district', 'resource_id' => '21' ],
    	['resource_name' => 'district', 'resource_id' => '22' ],
    	['resource_name' => 'region', 'resource_id' => '1' ],
    	['resource_name' => 'region', 'resource_id' => '2' ],
    	['resource_name' => 'region', 'resource_id' => '3' ],
    	['resource_name' => 'region', 'resource_id' => '4' ],
        ['resource_name' => 'regions', 'resource_id' => null]
    	
    ];
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach ($this->resources as $resource) {
        	DB::table('resources')->insert($resource);
        }
    }
}
