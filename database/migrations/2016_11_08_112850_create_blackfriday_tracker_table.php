<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBlackfridayTrackerTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
    	Schema::create('doorcrasher_tracker', function (Blueprint $table) {
			$table->bigIncrements('id');
	        $table->string('store_style')->nullable();
			$table->string('store_number')->nullable();
			$table->string('store_name')->nullable();
			$table->string('dpt_number')->nullable();
			$table->string('dpt_name')->nullable();
			$table->string('sdpt_number')->nullable();
			$table->string('sdpt_name')->nullable();
			$table->string('cls_number')->nullable();
			$table->string('cls_name')->nullable();
			$table->string('scls_number')->nullable();
			$table->string('scls_name')->nullable();
			$table->string('brand')->nullable();
			$table->string('style_number')->nullable();
			$table->string('style_name')->nullable();
			$table->string('clr_code')->nullable();
			$table->string('clr_name')->nullable();
			$table->string('oh_qty')->nullable();
			$table->string('oh_avail_qty')->nullable();
			$table->string('it_qty')->nullable();
			$table->string('ootr_qty')->nullable();
			$table->string('ooasn_qty')->nullable();
			$table->string('oopo_qty')->nullable();
			$table->string('oh_rtl')->nullable();
			$table->string('oh_avail_rtl')->nullable();
			$table->string('it_rtl')->nullable();
			$table->string('ootr_rtl')->nullable();
			$table->string('ooasn_rtl')->nullable();
			$table->string('oopo_rtl')->nullable();
			$table->string('oh_avg_rtl')->nullable();
			$table->string('org_div')->nullable();
			$table->string('org_div_style')->nullable();
			$table->nullableTimestamps();
		});
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
		Schema::drop('doorcrasher_tracker');
    }
}
