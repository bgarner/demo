<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTasksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tasks', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->text('description');
            $table->dateTime('due_date');
            $table->dateTime('publish_date');
            $table->boolean('send_reminder');
            $table->integer('banner_id')->unsigned();
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('banner_id')->references('id')->on('banners');                                                  
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('tasks');
    }
}
