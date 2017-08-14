<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAnalyticsCollectionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('analytics_collection', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('resource_id')->unsigned();
            $table->integer('asset_type_id')->unsigned();
            $table->integer('opened_total')->unsigned();
            $table->integer('unopened_total')->unsigned();
            $table->integer('sent_to_total')->unsigned();
            $table->text('opened');
            $table->text('unopened');
            $table->text('sent_to');
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
        Schema::dropIfExists('analytics_collection');
    }
}
