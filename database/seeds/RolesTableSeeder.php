<?php

use Illuminate\Database\Seeder;

class RolesTableSeeder extends Seeder
{
    
    private $roles = [

        [ 'id' =>1, 'role_name' => 'Admin'],
        [ 'id' =>2, 'role_name' => 'Content Uploaders' ],
        [ 'id' =>3, 'role_name' => 'Video Uploaders' ],
        [ 'id' =>4, 'role_name' => 'Exec' ],
        [ 'id' =>5, 'role_name' => 'AVP' ],
        [ 'id' =>6, 'role_name' => 'District Manager' ],
        [ 'id' =>7, 'role_name' => 'Store Manager' ]

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
