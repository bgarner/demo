<?php

use Illuminate\Database\Seeder;

class TaskStoreStatusTypesSeeder extends Seeder
{
    private $task_status_types = [
    	['id'=>1, 'status_title' => 'not done'],
    	['id'=>2, 'status_title' => 'done']

    ];
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach ($this->task_status_types as $status_type) {
        	DB::table('task_store_status_types')->insert($status_type);	
        }
        
    }
}
