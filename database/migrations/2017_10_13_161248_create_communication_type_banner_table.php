<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCommunicationTypeBannerTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('communication_type_banner', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('communication_type_id')->unsigned();
            $table->integer('banner_id')->unsigned();
            $table->timestamps();
            $table->foreign('communication_type_id')->references('id')->on('communication_types')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('communication_type_banner');
    }
}
