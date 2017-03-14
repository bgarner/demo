<?php

use Illuminate\Database\Seeder;

class RolesTableSeeder extends Seeder
{
    
    private $roles = [
        [ 'role_name' => 'Store Manager'],
    	[ 'role_name' => 'District Manager' ],
    	[ 'role_name' => 'AVP' ],
		[ 'role_name' => 'Exec' ]

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
