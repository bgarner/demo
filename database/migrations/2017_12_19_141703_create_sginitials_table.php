<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSginitialsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('softgoods_initials', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->string('store_number', 255);
            $table->string('division', 255)->nullable();
            $table->string('department', 255)->nullable();
            $table->string('subdepartment', 255)->nullable();
            $table->string('category', 255)->nullable();
            $table->string('brand', 255)->nullable();
            $table->string('style_number', 255)->nullable();
            $table->string('style_name', 255)->nullable();
            $table->string('codi_number', 11)->nullable();
            $table->integer('ly_month1')->nullable();
            $table->integer('ly_month2')->nullable();
            $table->integer('ly_month3')->nullable();
            $table->integer('ly_season_total')->nullable();
            $table->integer('cy_month1')->nullable();
            $table->integer('cy_month2')->nullable();
            $table->integer('cy_month3')->nullable();
            $table->integer('cy_season_total')->nullable();
            $table->nullableTimestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('softgoods_initials');
    }
}
