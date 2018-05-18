<?php

use Illuminate\Database\Seeder;
use App\Models\Form\FormTarget;

class FormTargetTableSeeder extends Seeder
{
    private $stores = [

			'0346',
			'0361',
			'0335',
			'0385',
			'0185',
			'0260',
			'0280',
			'0310',
			'0314',
			'0384',
			'0375',
			'0299',
			'0394',
			'0317',
			'0259',
			'0419',
			'0255',
			'0274',
			'0322',
			'0371',

    ];
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach ($this->stores as $store_id) {
        	FormTarget::create([
        		'form_id' => 1,
        		'store_id' => $store_id
        	]);


        }
    }
}
