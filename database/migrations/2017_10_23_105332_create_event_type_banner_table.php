<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEventTypeBannerTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('event_type_banner', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('event_type_id')->unsigned();
            $table->integer('banner_id')->unsigned();
            $table->timestamps();
            $table->foreign('event_type_id')->references('id')->on('event_types')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('event_type_banner');
    }
}
