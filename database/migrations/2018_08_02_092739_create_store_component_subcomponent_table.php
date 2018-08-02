<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStoreComponentSubcomponentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('store_components_subcomponents', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('parent_component_id')->unsigned();
            $table->string('subcomponent_name');
            $table->string('subcomponent_label');
            $table->integer('banner_id')->unsigned();
            $table->string('config');
            $table->foreign('banner_id')->references('id')->on('banners');
            $table->string('subcomponent_url');
            $table->foreign('parent_component_id')->references('id')->on('store_components')->onDelete('cascade');
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
        Schema::dropIfExists('store_components_subcomponents');
    }
}
