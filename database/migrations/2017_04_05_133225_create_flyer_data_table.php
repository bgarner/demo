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
            $table->text('category');
            $table->text('brand_name');
            $table->text('product_name');
            $table->text('pmm');
            $table->text('disclaimer');
            $table->text('original_price');
            $table->text('sale_price');
            $table->text('notes');
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
