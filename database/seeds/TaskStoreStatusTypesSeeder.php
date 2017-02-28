<?php

use Illuminate\Database\Seeder;

class TaskStoreStatusTypesSeeder extends Seeder
{
    private $task_status_types = [
    	['status_title' => 'seen'],
    	['status_title' => 'done'],
    	['status_title' => 're-assign to store']

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
