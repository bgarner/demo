<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBikeCountTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bike_count', function (Blueprint $table) {
            $table->increments('id');
            $table->string('store_number', 255);
            $table->string('store_name', 255)->nullable();
            $table->string('class', 255)->nullable();
            $table->string('gender', 255)->nullable();
            $table->string('brand', 255)->nullable();
            $table->string('style', 255)->nullable();
            $table->string('style_name', 255)->nullable();
            $table->string('colour', 255)->nullable();
            $table->string('size', 255)->nullable();
            $table->integer('on_hand')->nullable();
            $table->integer('in_transit')->nullable();
            $table->nullableTimestamps();
        });
    }

}
