<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFeaturesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('features', function ($table) {
            $table->increments('id')->unsigned();
            $table->integer('banner_id')->unsigned();
            $table->mediumText('title'); 
            $table->mediumText('description'); 
            $table->string('background_image');
            $table->date('start');
            $table->date('end')->nullable(); 

            $table->foreign('banner_id')->references('id')->on('banners')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('features', function (Blueprint $table) {
            Schema::dropIfExists('features');
        });
    }
}
