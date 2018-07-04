<?php

use Illuminate\Database\Seeder;
use App\Models\Form\FormResolution;

class FormResolutionCodeSeeder extends Seeder
{
    private $resolutionCodes = [
    	
	    [
	    	'form_id' => 1,
	    	'resolution_code' =>   'Inventory allocated prior to request'
	    ],
	    [
	    	'form_id' => 1,
	    	'resolution_code' =>   'Inventory allocated in response of request'
	    ],
	    [
	    	'form_id' => 1,
	    	'resolution_code' =>   'Inventory will be allocated once it delivers to DC'
	    ],
	    [
	    	'form_id' => 1,
	    	'resolution_code' =>   'Inventory is not available to allocate'
	    ]

    ];
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach($this->resolutionCodes as $code)
        {
        	FormResolution::create($code);
        }
    }
}
