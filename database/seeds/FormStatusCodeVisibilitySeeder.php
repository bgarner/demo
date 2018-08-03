<?php

use Illuminate\Database\Seeder;
use App\Models\Form\Status;

class FormStatusCodeVisibilitySeeder extends Seeder
{
	private $status_codes = 
	[

		['id'=> 1, 'visibility' => 0],
		['id'=> 2, 'visibility' => 1],
		['id'=> 3, 'visibility' => 1],
		['id'=> 4, 'visibility' => 1],
		['id'=> 5, 'visibility' => 1],
		['id'=> 6, 'visibility' => 1],
		['id'=> 7, 'visibility' => 0],

	];
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach($this->status_codes as $code)
        {
        	Status::find($code['id'])->update(['visible' => $code['visibility']]);
        }
    }
}
