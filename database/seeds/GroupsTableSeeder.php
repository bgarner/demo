<?php

use Illuminate\Database\Seeder;

class GroupsTableSeeder extends Seeder
{
    private $groups = [
        // [ 'id' =>1, 'name' => 'admin'],
    	[ 'id' =>2, 'name' => 'manager' ]

    ];

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	DB::table('groups')->where('id', 2)->delete();
        foreach ($this->groups as $group) {
        	DB::table('groups')->insert($group);
        }
    }
}
