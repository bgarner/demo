<?php

use Illuminate\Database\Seeder;

class TaskStatusTypesSeeder extends Seeder
{
    private $task_status_types = [
    	['id' => 1 , 'status_title' => 'Active', 'css_class' => 'label-info'],
    	['id' => 2 , 'status_title' => 'Passed', 'css_class' => 'label-danger'],
    	['id' => 3 , 'status_title' => 'Upcoming', 'css_class' => 'label-warning']

    ];
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach ($this->task_status_types as $status_type) {
        	DB::table('task_status_types')->insert($status_type);	
        }
        
    }
}
