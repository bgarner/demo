<?php

use Illuminate\Database\Seeder;

class RoleResourcesPivotSeeder extends Seeder
{
    
    private $roles_resources = [
    	['role_id' => 1, 'resource_id' =>1 ],
    	['role_id' => 1, 'resource_id' =>2 ],
    	['role_id' => 1, 'resource_id' =>3 ],
    	['role_id' => 1, 'resource_id' =>4 ],
    	['role_id' => 1, 'resource_id' =>5 ],
    	['role_id' => 1, 'resource_id' =>6 ],
    	['role_id' => 1, 'resource_id' =>7 ],
    	['role_id' => 1, 'resource_id' =>8 ],
    	['role_id' => 1, 'resource_id' =>9 ],
    	['role_id' => 1, 'resource_id' =>10 ],
    	['role_id' => 1, 'resource_id' =>11 ],
    	['role_id' => 1, 'resource_id' =>12 ],
    	['role_id' => 1, 'resource_id' =>13 ],
    	['role_id' => 1, 'resource_id' =>14 ],
    	['role_id' => 1, 'resource_id' =>15 ],
    	['role_id' => 1, 'resource_id' =>16 ],
    	['role_id' => 1, 'resource_id' =>17 ],
    	['role_id' => 1, 'resource_id' =>18 ],
    	['role_id' => 1, 'resource_id' =>19 ],
    	['role_id' => 1, 'resource_id' =>20 ],
    	['role_id' => 1, 'resource_id' =>21 ],
    	['role_id' => 1, 'resource_id' =>22 ],
    	['role_id' => 2, 'resource_id' =>23 ],
    	['role_id' => 2, 'resource_id' =>24 ],
    	['role_id' => 2, 'resource_id' =>25 ],
    	['role_id' => 2, 'resource_id' =>26 ],
    	['role_id' => 3, 'resource_id' =>27 ],


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
