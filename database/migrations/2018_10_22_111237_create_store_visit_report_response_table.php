<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStoreVisitReportResponseTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('store_visit_report_response', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('report_instance_id')->unsigned();
            $table->integer('field_id')->unsigned();
            $table->mediumText('response');
            $table->timestamps();
            $table->foreign('report_instance_id')->references('id')->on('store_visit_report_instance');
            $table->foreign('field_id')->references('id')->on('store_visit_report_field');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('store_visit_report_response');
    }
}
