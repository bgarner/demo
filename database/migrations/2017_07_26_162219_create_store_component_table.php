<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStoreComponentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('store_components', function (Blueprint $table) {
            $table->increments('id');
            $table->string('component_name');
            $table->integer('banner_id')->unsigned();
            $table->integer('config');
            $table->foreign('banner_id')->references('id')->on('banners')->onDelete('cascade');
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
        Schema::dropIfExists('store_components');
    }
}
