<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStoresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stores', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('store_id');
            $table->string('store_number',11)->unique;
            $table->boolean('is_combo_store');
            $table->string('name',255);
            $table->string('address', 255);
            $table->string('city', 255);
            $table->string('province', 255);
            $table->string('postal_code', 255);
            $table->string('phone', 255);
            $table->string('fax', 255);
            $table->string('email', 255);
            $table->double('lat', 9,6);
            $table->double('long', 9,6);
            $table->double('sqft');
            $table->boolean('mall_entrance');
            $table->integer('entrances');
            $table->integer('cashbanks');
            $table->softDeletes();
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
        Schema::dropIfExists('stores');
    }
}
