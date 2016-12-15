<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductlaunchTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('productlaunch', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('store_style')->nullable();
            $table->string('store_number')->nullable();
            $table->string('store_name')->nullable();
            $table->string('dpt_number')->nullable();
            $table->string('dpt_name')->nullable();
            $table->string('sdpt_number')->nullable();
            $table->string('sdpt_name')->nullable();
            $table->string('cls_number')->nullable();
            $table->string('cls_name')->nullable();
            $table->string('scls_number')->nullable();
            $table->string('scls_name')->nullable();
            $table->string('brand')->nullable();
            $table->string('style_number')->nullable();
            $table->string('style_name')->nullable();
            $table->string('clr_code')->nullable();
            $table->string('clr_name')->nullable();
            $table->timestamp('launch_date')->nullable();
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
        Schema::drop('productlaunch');
    }
}
