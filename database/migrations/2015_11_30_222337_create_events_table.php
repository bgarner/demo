<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEventsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('events', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->integer('banner_id')->unsigned();
            $table->mediumText('title');    
            $table->longText('description');
            $table->integer('event_type')->unsigned();
            $table->date('start');
            $table->date('end')->nullable(); 
            $table->softDeletes();
            $table->timestamps();
            $table->foreign('banner_id')->references('id')->on('banners');
            $table->foreign('event_type')->references('id')->on('event_types');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('events', function (Blueprint $table) {
            Schema::dropIfExists('events');
        });
    }
}
