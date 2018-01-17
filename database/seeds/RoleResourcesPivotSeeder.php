<?php

use Illuminate\Database\Seeder;

class RoleResourcesPivotSeeder extends Seeder
{
    
    private $roles_resources = [

            ['role_id' => 7 , 'resource_type_id' => 1],
            ['role_id' => 6 , 'resource_type_id' => 2],
            ['role_id' => 5 , 'resource_type_id' => 3],
            ['role_id' => 4 , 'resource_type_id' => 4]
    ];

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach ($this->roles_resources as $row) {
        	DB::table('role_resource')->insert($row);
        }
    }
}
