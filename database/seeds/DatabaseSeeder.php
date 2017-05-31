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
        $this->call(GroupsTableSeeder::class);
        $this->call(RolesTableSeeder::class);
        $this->call(ComponentsTableSeeder::class);
        
        $this->call(ResourceTypeTableSeeder::class);
        $this->call(ResourcesTableSeeder::class);
        $this->call(GroupRolesPivotSeeder::class);
        $this->call(RoleResourcesPivotSeeder::class);
        $this->call(RoleComponentPivotSeeder::class);
        $this->call(TaskStatusTypesSeeder::class);
        $this->call(TaskStoreStatusTypesSeeder::class);
        $this->call(VideoTableSeeder::class);

    }
}
