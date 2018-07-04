<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBugReportTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bug_reports', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('banner');    
            $table->string('user');
            $table->string('user_email');
            $table->boolean('follow_up');
            $table->string('store_number');
            $table->string('current_url');
            $table->text('description');
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
        Schema::drop('bug_reports');
    }
}
