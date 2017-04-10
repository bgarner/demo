<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFlyerDataTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('flyer_data', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('flyer_id')->unsigned();
            $table->string('category');
            $table->string('brand_name');
            $table->string('product_name');
            $table->text('pmm');
            $table->text('disclaimer');
            $table->string('original_price');
            $table->string('sale_price');
            $table->text('notes');
            $table->text('colour');
            $table->softDeletes();
            $table->timestamps();
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
        Schema::drop('flyer_data');
    }
}
