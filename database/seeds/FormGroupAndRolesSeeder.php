<?php

use Illuminate\Database\Seeder;
use App\Models\Auth\Group\Group;
use App\Models\Auth\Role\Role;
use App\Models\Auth\Group\GroupRole;


class FormGroupAndRolesSeeder extends Seeder
{
    private $roles = [

        ['role_name' => 'Product Request Form Admin'],
        ['role_name' => 'Product Request Business Unit Admin' ],
        ['role_name' => 'Analyst' ],

    ];
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $group = Group::create([
        	'id' => '3',
        	'name' => 'form'
        ]);

        foreach ($this->roles as $role) {
        	$createdRole = Role::create($role);
        	GroupRole::create([
        		'group_id' => $group->id,
                'role_id' => $createdRole->id
        	]);
        }
    }
}
