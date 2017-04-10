<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFeatureFlyerPivot extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('feature_flyer', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('feature_id')->unsigned();
            $table->integer('flyer_id')->unsigned();
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('feature_id')->references('id')->on('features')->onDelete('cascade');
            $table->foreign('flyer_id')->references('id')->on('flyers')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('feature_flyer');
    }
}
