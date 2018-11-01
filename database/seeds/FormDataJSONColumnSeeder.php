<?php

use Illuminate\Database\Seeder;
use App\Models\Form\FormData;

class FormDataJSONColumnSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $formData = FormData::all();
        foreach ($formData as $key=>$value) {

        	$formData[$key]->update(
        			['json_form_data' => json_encode(unserialize($value->form_data))]
        		);
        }
    }
}
