<?php

use Illuminate\Database\Seeder;

class FormPermissionTableSeeder extends Seeder
{
    private $permissions = [

        ['module' => 'User', 'module_namespace' => ''],
        ['module' => 'Group', 'module_namespace' => ''],
        ['module' => 'Assign User to Group', 'module_namespace' => ''],
        ['module' => 'Assign Form to Group', 'module_namespace' => ''],
        ['module' => 'Assign Form to User', 'module_namespace' => ''],

    ];
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        foreach ($this->permissions as $permission) {
        	$p = \DB::table('form_permissions')->insert($permission);

        }
    }
}
