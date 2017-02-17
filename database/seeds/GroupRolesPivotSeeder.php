<?php

use Illuminate\Database\Seeder;

class GroupRolesPivotSeeder extends Seeder
{
    private $group_roles = [
    	
    	['group_id' => 3, 'role_id' => 1],
    	['group_id' => 3, 'role_id' => 2],
    	['group_id' => 3, 'role_id' => 3]


    ];
     /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach ($this->group_roles as $row) {
        	DB::table('group_role')->insert($row);
        }
    }
}
