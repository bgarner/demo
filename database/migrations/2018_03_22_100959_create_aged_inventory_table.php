<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAgedInventoryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('aged_inventory', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('store_number');
            $table->string('category', 25);
            $table->string('department', 50);
            $table->string('assortment', 50);
            $table->string('style_colour', 20);
            $table->string('style_name', 255);
            $table->integer('on_hand');
            $table->boolean('location_front');
            $table->boolean('location_back');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('aged_inventory');
    }
}
