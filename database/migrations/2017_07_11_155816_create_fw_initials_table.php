<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFwInitialsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('footwear_initials', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->string('store_number', 255);
            $table->string('department', 255)->nullable();
            $table->string('subdepartment', 255)->nullable();
            $table->string('category', 255)->nullable();
            $table->string('brand', 255)->nullable();
            $table->integer('ly_june')->nullable();
            $table->integer('ly_july')->nullable();
            $table->integer('ly_aug')->nullable();
            $table->integer('ly_sept')->nullable();
            $table->integer('ly_oct')->nullable();
            $table->integer('ly_nov')->nullable();
            $table->integer('ly_dec')->nullable();
            $table->integer('ly_season2_total')->nullable();
            $table->integer('cy_june')->nullable();
            $table->integer('cy_july')->nullable();
            $table->integer('cy_aug')->nullable();
            $table->integer('cy_sept')->nullable();
            $table->integer('cy_oct')->nullable();
            $table->integer('cy_nov')->nullable();
            $table->integer('cy_dec')->nullable();
            $table->integer('cy_season2_total')->nullable();
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
        Schema::drop('footwear_initials');
    }
}
