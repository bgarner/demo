<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFormRoleTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('form_role', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('form_id')->unsigned();
            $table->integer('role_id')->unsigned();
            $table->timestamps();
            $table->foreign('form_id')->references('id')->on('forms');
            $table->foreign('role_id')->references('id')->on('roles');    
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('form_role');
    }
}
