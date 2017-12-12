<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFootwearIntialsRollingMonthTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('footwear_initials_rolling_months', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->string('month1', 255);
            $table->string('month2', 255);
            $table->string('month3', 255);
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
        Schema::dropIfExists('footwear_initials_rolling_months');
    }
}
