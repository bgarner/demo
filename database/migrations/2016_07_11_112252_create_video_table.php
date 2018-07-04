<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVideoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('videos', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->string('upload_package_id');
            $table->string('original_filename');
            $table->string('filename');
            $table->string('original_extension');
            $table->string('title');
            $table->string('description');
            $table->integer('uploader')->unsigned();
            $table->integer('likes')->unsigned();
            $table->integer('dislikes')->unsigned();
            $table->boolean('featured');
            $table->foreign('uploader')->references('id')->on('users')->onDelete('cascade');
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
        Schema::drop('videos');
    }
}
