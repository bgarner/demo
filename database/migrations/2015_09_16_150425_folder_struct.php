<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class FolderStruct extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('folder_struct', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('parent')->unsigned();
            $table->integer('child')->unsigned();
            $table->timestamps();

            $table->foreign('parent')->references('id')->on('folders')->onDelete('cascade');
            $table->foreign('child')->references('id')->on('folders');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('folder_struct');
    }
}
