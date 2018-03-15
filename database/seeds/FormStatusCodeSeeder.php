<?php

use Illuminate\Database\Seeder;
use App\Models\Form\Status;

class FormStatusCodeSeeder extends Seeder
{
    private $formStatusCodes = [ 
    	["store_status" =>	'submitted', 'admin_status' => 'submitted', 'icon'=>'fa-paper-plane', 'colour' => 'green-bg'], 
    	["store_status" =>	'in progress', 'admin_status' => 'in progress', 'icon'=>'fa-clock-o', 'colour' => 'blue-bg'], 
    	["store_status" =>	'approved', 'admin_status' => 'approved', 'icon'=>'fa-thumbs-o-up', 'colour' => 'green-bg'], 
    	["store_status" =>	'not approved', 'admin_status' => 'not approved', 'icon'=>'fa-frown-o', 'colour' => 'red-bg'], 
    	["store_status" =>	'closed', 'admin_status' => 'closed', 'icon'=>'fa-times-circle', 'colour' => 'black-bg'],
        ["store_status" =>  'question', 'admin_status' => 'question', 'icon'=>'fa-question', 'colour' => 'red-bg']

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
