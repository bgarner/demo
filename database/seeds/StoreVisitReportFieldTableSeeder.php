<?php

use Illuminate\Database\Seeder;
use App\Models\StoreVisitReport\StoreVisitReportField;
use Carbon\Carbon;

class StoreVisitReportFieldTableSeeder extends Seeder
{
    
	private $fields = [

			[
				"field" => "Last Week's Tablet Sales Result",
				"field_alias" => "field_1"
			],
			[
				"field" => "6Wk Trend Tablet Sales Result",
				"field_alias" => "field_2"
			],
			[
				"field" => "Are PDTs and Tablets in use in each dept?",
				"field_alias" => "field_3"
			],
			[
				"field" => "Validate staff understanding and coach Winning Habits. Provide findings and coaching notes",
				"field_alias" => "field_4"
			],

			[
				"field" => "How is Tablet Sales being coached / communicated on a daily basis?",
				"field_alias" => "field_5"
			],

			[
				"field" => "IMPROVEMENT PLAN for TABLET SALES",
				"field_alias" => "field_6"
			],
			[
				"field" => "Reviewed hiring needs and open postings",
				"field_alias" => "field_7"
			],
			[
				"field" => "Are schedules being posted 3 weeks out?",
				"field_alias" => "field_8"
			],
			[
				"field" => "Is Autofill being used weekly?",
				"field_alias" => "field_9"
			],
			[
				"field" => "Validate that the management schedule aligns with business needs. Provide findings and coaching notes",
				"field_alias" => "field_10"
			],

			[
				"field" => "Validate that staff schedule aligns with business needs. Provide findings and coaching notes",
				"field_alias" => "field_11"
			],

			[
				"field" => "IMPROVEMENT PLAN for EFFECTIVE SCHEDULING",
				"field_alias" => "field_12"
			],
			[
				"field" => "MOD Schedule is in place and posted?",
				"field_alias" => "field_13"
			],
			[
				"field" => "MOD Show Me Steps are at 100%?",
				"field_alias" => "field_14"
			],
			[
				"field" => "Validate management understanding and coach Winning Habits. Provide findings and coaching notes",
				"field_alias" => "field_15"
			],

			[
				"field" => "How well is this executed in store? Is it effective, making an impact? Provide findings, coaching notes",
				"field_alias" => "field_16"
			],

			[
				"field" => "IMPROVEMENT PLAN for MOD",
				"field_alias" => "field_17"
			],
			[
				"field" => "Last Week's Aged Orders%",
				"field_alias" => "field_18"
			],
			[
				"field" => "6Wk Trend Aged Orders %",
				"field_alias" => "field_19"
			],
			[
				"field" => "Last Week's Dirty Node %",
				"field_alias" => "field_20"
			],
			[
				"field" => "6Wk Trend Dirty Node %",
				"field_alias" => "field_21"
			],
			[
				"field" => "Is store using DOM Staffing Tool for scheduling? Determine packer/picking hours?",
				"field_alias" => "field_22"
			],

			[
				"field" => "Has the store reviewed upcoming order forecast to assess supply needs?",
				"field_alias" => "field_23"
			],

			[
				"field" => "Validate dirty nodes list on portal and weekly use of dirty node scanning app. Provide findings, notes",
				"field_alias" => "field_24"
			],

			[
				"field" => "Validate that Stock Locator setup is underway or in place (where applicable). Provide findings, notes",
				"field_alias" => "field_25"
			],

			[
				"field" => "IMPROVEMENT PLAN for DOM",
				"field_alias" => "field_26"
			],
			[
				"field" => "Last Month's Self Audit %",
				"field_alias" => "field_27"
			],
			[
				"field" => "Last Official Full Store Audit %",
				"field_alias" => "field_28"
			],
			[
				"field" => "Are thorough, accurate Self Audits being completed by SGM monthly?",
				"field_alias" => "field_29"
			],

			[
				"field" => "Are thorough bag checks are being completed every night?",
				"field_alias" => "field_30"
			],
			[
				"field" => "Audit 5 new hire employee files for ALL necessary forms, signatures, etc. Provide findings, notes",
				"field_alias" => "field_31"
			],

			[
				"field" => "IMPROVEMENT PLAN for AUDITS",
				"field_alias" => "field_32"
			],
			[
				"field" => "Validate the following where applicable: Category Store Setup, Helly Shops, Woods Shops, Gym Bag fixture, Holiday Impulse Lanes, 
				Sports Nutrition. Provide findings and notes",
				"field_alias" => "field_33"
			],

			[
				"field" => "IMPROVEMENT PLAN on INVENTORY INTENSITY",
				"field_alias" => "field_34"
			],
			[
				"field" => "IMPROVEMENT PLAN for 5 Success Factors",
				"field_alias" => "field_35"
			],
			[
				"field" => "IMPROVEMENT PLAN for TRIBAL CUSTOMS",
				"field_alias" => "field_36"
			],
			[
				"field" => "Overall Comments",
				"field_alias" => "field_37"
			]


                    

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
        		"field" =>$field["field"],
        		"field_alias" =>$field["field_alias"],
        	]);
        }
    }
}
