<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStoreVisitReportTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('store_visit_report', function (Blueprint $table) {
            $table->increments('id');
            $table->datetime('submitted_at');
            $table->string('store_number');
            $table->integer('dm')->unsigned();


            $table->string('lw_tablet_sales_result');
            $table->string('6wk_trend_tablet_sales_result');
            $table->boolean('pdt_and_tab_used_in_each_dept');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('store_visit_report');
    }
}
