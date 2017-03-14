<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(ComponentsTableSeeder::class);
        $this->call(ResourcesTableSeeder::class);
        $this->call(RolesTableSeeder::class);
        $this->call(RoleResourcesPivotSeeder::class);
        $this->call(RoleResourcesPivotSeeder::class);
        $this->call(GroupRolesPivotSeeder::class);
        $this->call(TaskStatusTypesSeeder::class);
        $this->call(TaskStoreStatusTypesSeeder::class);
    }
}
