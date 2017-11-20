<?php

use Illuminate\Database\Seeder;
use App\Models\Auth\Component\Component;

class ComponentDeletablePropertySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $components = Component::where('id', '!=', 1)->get();
        foreach($components as $component){
        	$component['deletable'] = 1;
        	$component->save();
        }
    }
}
