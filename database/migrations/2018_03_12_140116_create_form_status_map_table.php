<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFormStatusMapTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('form_status_map', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('form_id')->unsigned();
            $table->integer('status_id')->unsigned();
            $table->timestamps();
            $table->foreign('form_id')->references('id')->on('forms');
            $table->foreign('status_id')->references('id')->on('form_status_code');            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('form_status_map');
    }
}
