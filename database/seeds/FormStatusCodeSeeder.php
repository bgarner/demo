<?php

use Illuminate\Database\Seeder;
use App\Models\Form\Status;

class FormStatusCodeSeeder extends Seeder
{
    private $formStatusCodes = [ 
    	["store_status" =>	'New', 'admin_status' => 'New', 'icon'=>'fa-paper-plane', 'colour' => 'green-bg'], 
    	["store_status" =>	'In Progress', 'admin_status' => 'In Progress', 'icon'=>'fa-clock-o', 'colour' => 'blue-bg'], 
    	["store_status" =>	'Fulfilled', 'admin_status' => 'Fulfilled', 'icon'=>'fa-thumbs-o-up', 'colour' => 'green-bg'], 
    	["store_status" =>	'Not Fulfilled', 'admin_status' => 'Not Fulfilled', 'icon'=>'fa-frown-o', 'colour' => 'red-bg'], 
    	["store_status" =>	'Closed', 'admin_status' => 'Closed', 'icon'=>'fa-times-circle', 'colour' => 'black-bg'],
        ["store_status" =>  'Question', 'admin_status' => 'Question', 'icon'=>'fa-question', 'colour' => 'yellow-bg']

    ];
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
		foreach ($this->formStatusCodes as $value) {
        	Status::create($value);
        }
    }
}
