<?php

use Illuminate\Database\Seeder;
use App\Models\Form\Form;

class UpdateFormTableSeeder extends Seeder
{
    private $forms = [ 
        
        [   
            'id'               => 2,
            'form_name'        => 'inventory_adjustment_form',
            'form_label'       => 'Inventory Adjustment Form',
            'version'          => '1.0',
            'description'      => 'This form is for requesting new product or getting more or less of some existing product',
            'form_path'        => 'inventoryadjustment'
        ]

    ];
    
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach ($this->forms as $value) {
            $form = Form::create($value);            
        }
    }
}
