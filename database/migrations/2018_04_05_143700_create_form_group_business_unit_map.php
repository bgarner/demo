<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFormGroupBusinessUnitMap extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('form_business_unit_group', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('group_id')->unsigned();
            $table->integer('business_unit_id')->unsigned();
            $table->timestamps();
            $table->foreign('group_id')->references('id')->on('form_usergroups');
            $table->foreign('business_unit_id')->references('id')->on('form_business_unit_types');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('form_business_unit_group');
    }
}
