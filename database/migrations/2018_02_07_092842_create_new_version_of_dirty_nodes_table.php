<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNewVersionOfDirtyNodesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dirty_nodes', function (Blueprint $table) {
            $table->increments('id')->autoIncrement();
            $table->string('banner');
            $table->string('store');
            $table->string('avp');
            $table->string('dm');
            $table->string('storename');
            $table->string('node_key');
            $table->string('item_id_sku');
            $table->string('stylecode');
            $table->string('styledesc');
            $table->string('color');
            $table->string('sizename');
            $table->string('upccode');
            $table->string('startdate');
            $table->integer('week');
            $table->string('starttime');
            $table->string('enddate');
            $table->string('endtime');
            $table->integer('quantity');
            $table->text('reasoncode');
            $table->string('product_status_name');
            $table->string('department');
            $table->string('sub_department');
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
        Schema::dropIfExists('dirty_nodes_new');
    }
}
