<?php

use Illuminate\Database\Seeder;

class GroupRolesPivotSeeder extends Seeder
{
    private $group_roles = [
    	
 
        ['id'=> 1,'group_id' => 1, 'role_id' => 1],
        ['id'=> 2,'group_id' => 1, 'role_id' => 2],
        ['id'=> 3,'group_id' => 1, 'role_id' => 3],
        ['id'=> 4,'group_id' => 2, 'role_id' => 4],
        ['id'=> 5,'group_id' => 2, 'role_id' => 5],
        ['id'=> 6,'group_id' => 2, 'role_id' => 6],
        ['id'=> 7,'group_id' => 2, 'role_id' => 7],



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
