<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNewAnalyticsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //type, resource, store, location, location_id
        Schema::create('analytics', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->string('type');
            $table->integer('resource_id');
            $table->string('store_number');
            $table->string('location');
            $table->integer('location_id');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('analytics');
    }
}
