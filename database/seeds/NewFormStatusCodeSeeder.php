<?php

use Illuminate\Database\Seeder;
use App\Models\Form\Status;

class NewFormStatusCodeSeeder extends Seeder
{
    private $formStatusCodes = [ 
    	
        ["store_status" =>  'Question Responded', 'admin_status' => 'Question Responded', 'visible' => '0',  'icon'=>'fa-question', 'colour' => 'green-bg']

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
