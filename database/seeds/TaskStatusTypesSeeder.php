<?php

use Illuminate\Database\Seeder;

class TaskStatusTypesSeeder extends Seeder
{
    private $task_status_types = [
    	['status_title' => 'Active', 'css_class' => 'label-info'],
    	['status_title' => 'Passed', 'css_class' => 'label-danger'],
    	['status_title' => 'Upcoming', 'css_class' => 'label-warning']

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
