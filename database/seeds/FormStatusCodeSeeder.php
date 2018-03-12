<?php

use Illuminate\Database\Seeder;
use App\Models\Form\Status;

class FormStatusCodeSeeder extends Seeder
{
    private $formStatusCodes = [ 
    	["form_id" => 1, "store_status" =>	'submitted', 'admin_status' => 'new', 'icon'=>'fa-paper-plane', 'colour' => 'green-bg'], 
    	["form_id" => 1, "store_status" =>	'in progress', 'admin_status' => 'in progress', 'icon'=>'fa-clock-o', 'colour' => 'blue-bg'], 
    	["form_id" => 1, "store_status" =>	'approved', 'admin_status' => 'approved', 'icon'=>'fa-thumbs-o-up', 'colour' => 'green-bg'], 
    	["form_id" => 1, "store_status" =>	'not approved', 'admin_status' => 'not approved', 'icon'=>'fa-thumbs-o-down', 'colour' => 'green-bg'], 
    	["form_id" => 1, "store_status" =>	'closed', 'admin_status' => 'closed', 'icon'=>'fa-times-circle', 'colour' => 'green-bg']

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
