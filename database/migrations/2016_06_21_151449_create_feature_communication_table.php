<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFeatureCommunicationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('communication_types_features', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->integer('communication_type_id')->references('id')->on('communication_types');
            $table->integer('feature_id')->references('id')->on('features');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('communication_types_features');
    }
}
