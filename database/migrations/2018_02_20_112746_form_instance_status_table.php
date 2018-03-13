<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class FormInstanceStatusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('form_instance_status', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('form_data_id')->unsigned();
            $table->integer('status_code_id')->unsigned();
            $table->timestamps();
            $table->foreign('form_data_id')->references('id')->on('form_data');
            $table->foreign('status_code_id')->references('id')->on('form_status_code');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('form_instance_status');
    }
}
