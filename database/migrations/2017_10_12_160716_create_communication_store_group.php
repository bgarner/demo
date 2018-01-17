<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCommunicationStoreGroup extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('communication_store_group', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('communication_id')->unsigned();
            $table->integer('store_group_id')->unsigned();
            $table->timestamps();
            $table->foreign('communication_id')->references('id')->on('communications')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('communication_store_group');
    }
}
