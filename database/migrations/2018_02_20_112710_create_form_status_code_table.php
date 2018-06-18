<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFormStatusCodeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('form_status_code', function (Blueprint $table) {
            $table->increments('id');
            $table->string('store_status');
            $table->string('admin_status');
            $table->string('icon');
            $table->string('colour');
            $table->string('status_code_description');
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
        Schema::dropIfExists('form_status_code');
    }
}
