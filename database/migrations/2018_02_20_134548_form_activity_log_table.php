<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class FormActivityLogTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('form_activity_log', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('form_data_id')->unsigned();
            $table->mediumText('log');
            $table->timestamps();
            $table->foreign('form_data_id')->references('id')->on('form_data');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('form_activity_log');
    }
}
