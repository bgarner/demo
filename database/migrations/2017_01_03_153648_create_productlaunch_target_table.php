<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductlaunchTargetTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('productlaunch_target', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('productlaunch_id')->unsigned();
            $table->integer('store_id');
            $table->timestamps();
            $table->foreign('productlaunch_id')->references('id')->on('productlaunch')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('productlaunch_target');
    }
}
