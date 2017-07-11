<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFlashSaleTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('flash_sale', function (Blueprint $table) {
            $table->increments('id');
            $table->string('store_number', 255);
            $table->string('store_name', 255)->nullable();
            $table->string('department', 255)->nullable();
            $table->string('subdepartment', 255)->nullable();
            $table->string('class', 255)->nullable();
            $table->string('subclass', 255)->nullable();
            $table->string('style_number', 255)->nullable();
            $table->string('style_name', 255)->nullable();
            $table->string('size', 255)->nullable();
            $table->string('colour', 255)->nullable();
            $table->integer('on_hand')->nullable();
            $table->nullableTimestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
