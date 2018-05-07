<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFormProductfeedbackRoleHierarchy extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('form_role_hierarchy', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('manager_role_id')->unsigned();
            $table->integer('employee_role_id')->unsigned();
            $table->timestamps();
            $table->foreign('manager_role_id')->references('id')->on('roles');
            $table->foreign('employee_role_id')->references('id')->on('roles');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('form_role_hierarchy');
    }
}
