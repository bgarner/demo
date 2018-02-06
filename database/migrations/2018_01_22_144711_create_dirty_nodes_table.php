<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDirtyNodesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dirty_nodes', function (Blueprint $table) {
            $table->increments('id');
            $table->string('store_number', 255);
            $table->string('store_name', 255);
            $table->string('item_id', 255);
            $table->string('desc', 255);
            $table->string('UPC', 255);
            $table->dateTime('start_date');
            $table->integer('quantity')->unsigned();
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
        Schema::dropIfExists('dirty_nodes');
    }
}
