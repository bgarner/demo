<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTasklistStoreGroupTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tasklist_store_group', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('tasklist_id')->unsigned();
            $table->integer('store_group_id')->unsigned();
            $table->timestamps();
            $table->foreign('tasklist_id')->references('id')->on('tasklists')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tasklist_store_group');
    }
}
