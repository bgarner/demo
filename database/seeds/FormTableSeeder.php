<?php

use Illuminate\Database\Seeder;
use App\Models\Form\Form;

class FormTableSeeder extends Seeder
{
    private $forms = [ 
    	["form_name" =>	'store_feedback_form', 'version' => '1.0']

    ];
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach ($this->forms as $value) {
        	Form::create($value);
        }
    }
}
