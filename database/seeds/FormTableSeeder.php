<?php

use Illuminate\Database\Seeder;
use App\Models\Form\Form;
use App\Models\Form\Status;
use App\Models\Form\FormStatusMap;

class FormTableSeeder extends Seeder
{
    private $forms = [ 
    	
        [   'form_name'        => 'store_feedback_form',
            'form_label'       => 'Store Feedback',
            'version'          => '1.0',
            'form_description' => 'This form is for requesting new product or getting more or less of some existing product',
            'path'             => 'storefeedback'
        ]

    ];
    
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $status_ids = Status::all()->pluck('id');
        foreach ($this->forms as $value) {
        	$form = Form::create($value);
        	
        	foreach ($status_ids as $status_id) {
        		FormStatusMap::create([
	        		'form_id' => $form->id,
	        		'status_id' => $status_id
	        	]);	
        	}
        	
        }
    }
}
