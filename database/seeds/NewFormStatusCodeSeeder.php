<?php

use Illuminate\Database\Seeder;
use App\Models\Form\Status;
use App\Models\Form\FormStatusMap;

class NewFormStatusCodeSeeder extends Seeder
{
    private $formStatusCodes = [ 
    	
        [ 'id'=> 7, "store_status" =>  'Question Responded', 'admin_status' => 'Question Responded', 'visible' => '0',  'icon'=>'fa-question', 'colour' => 'green-bg']

    ];
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
		foreach ($this->formStatusCodes as $value) {
        	$status = Status::create($value);
            FormStatusMap::create(['form_id' => 1, 'status_id' => $status->id]);
        }
    }
}
