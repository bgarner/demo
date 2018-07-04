<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFormInstanceResolutionCodeMap extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('form_instance_resolution_code_map', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('form_instance_id')->unsigned();
            $table->integer('resolution_code_id')->unsigned();
            $table->timestamps();
            $table->foreign('form_instance_id')->references('id')->on('form_data');
            $table->foreign('resolution_code_id')->references('id')->on('form_resolution_code');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('form_instance_resolution_code_map');
    }
}
