<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTasklistTaskTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tasklist_tasks', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('tasklist_id')->unsigned();
            $table->integer('task_id')->unsigned();
            $table->timestamps();
            $table->foreign('tasklist_id')->references('id')->on('tasklists')->onDelete('cascade');
            $table->foreign('task_id')->references('id')->on('tasks')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tasklist_tasks');
    }
}
