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
            $table->increments('id')->unsigned();
            $table->timestamp('launch_date')->nullable();
            $table->string('style_number')->nullable();
            $table->string('vendor_code')->nullable();
            $table->string('dpt_name')->nullable();
            $table->string('sdpt_name')->nullable();
            $table->string('cls_name')->nullable();
            $table->string('style_name')->nullable();
            $table->string('retail_price')->nullable();
            $table->string('tracking')->nullable();
            $table->string('event_type')->nullable();
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
