<?php

use Illuminate\Database\Seeder;
use App\Models\StoreVisitReport\StoreVisitReportField;
use Carbon\Carbon;

class StoreVisitReportFieldTableSeeder extends Seeder
{
    
	private $fields = [

			"Last Week's Tablet Sales Result",
			"6Wk Trend Tablet Sales Result",
			"Are PDTs and Tablets in use in each dept?",
			"Validate staff understanding and coach Winning Habits. Provide findings and coaching notes",
			"How is Tablet Sales being coached / communicated on a daily basis?",
			"IMPROVEMENT PLAN for TABLET SALES",
                
			"Reviewed hiring needs and open postings",
			"Are schedules being posted 3 weeks out?",
			"Is Autofill being used weekly",
			"Validate that the management schedule aligns with business needs. Provide findings and coaching notes",
			"Validate that staff schedule aligns with business needs. Provide findings and coaching notes",
			"IMPROVEMENT PLAN for EFFECTIVE SCHEDULING",


			"MOD Schedule is in place and posted?",
			"MOD Show Me Steps are at 100%?",
			"Validate management understanding and coach Winning Habits. Provide findings and coaching notes",
			"How well is this executed in store? Is it effective, making an impact? Provide findings, coaching notes",
			"IMPROVEMENT PLAN for MOD",

			"Last Week's Aged Orders%",
			"6Wk Trend Aged Orders %",
			"Last Week's Dirty Node %",
			"6Wk Trend Dirty Node %",
			"Is store using DOM Staffing Tool for scheduling? Determine packer/picking hours?",
			"Has the store reviewed upcoming order forecast to assess supply needs?",
			"Validate dirty nodes list on portal and weekly use of dirty node scanning app. Provide findings, notes",
			"Validate that Stock Locator setup is underway or in place (where applicable). Provide findings, notes",
			"IMPROVEMENT PLAN for DOM",
                             
			"Last Month's Self Audit %",
			"Last Official Full Store Audit %",
			"Are thorough, accurate Self Audits being completed by SGM monthly?",
			"Are thorough bag checks are being completed every night?",
			"Audit 5 new hire employee files for ALL necessary forms, signatures, etc. Provide findings, notes",
			"IMPROVEMENT PLAN for AUDITS",
                               
                            
			"Validate the following where applicable: Category Store Setup, Helly Shops, Woods Shops, Gym Bag fixture, Holiday Impulse Lanes, Sports Nutrition. Provide findings and notes",
			"IMPROVEMENT PLAN on INVENTORY INTENSITY",
                                                
			"IMPROVEMENT PLAN for 5 Success Factors",
			"IMPROVEMENT PLAN for TRIBAL CUSTOMS",
			"Overall Comments",
                    
                    

	];
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach ($this->fields as $field) {
        	StoreVisitReportField::create([
        		"field" =>$field
        	]);
        }
    }
}
