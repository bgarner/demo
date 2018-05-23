<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFormGroupFormInstance extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('form_group_form_instance', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('form_group_id')->unsigned();
            $table->integer('form_instance_id')->unsigned();
            $table->timestamps();
            $table->foreign('form_group_id')->references('id')->on('form_usergroups');
            $table->foreign('form_instance_id')->references('id')->on('form_data');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('form_group_form_instance');
    }
}
