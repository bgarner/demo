<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFeatureEventTypeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('feature_event_type', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('feature_id')->unsigned();
            $table->integer('event_type_id')->unsigned();
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('feature_id')->references('id')->on('features')->onDelete('cascade');
            $table->foreign('event_type_id')->references('id')->on('event_types')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('feature_event_type');
    }
}
