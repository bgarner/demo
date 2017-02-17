<?php

use Illuminate\Database\Seeder;

class RolesTableSeeder extends Seeder
{
    
    private $roles = [
    	[ 'role_name' => 'dm' ],
    	[ 'role_name' => 'avp' ],
		[ 'role_name' => 'exec' ]

    ];
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach ($this->roles as $role) {
        	DB::table('roles')->insert($role);
        }
    }
}
