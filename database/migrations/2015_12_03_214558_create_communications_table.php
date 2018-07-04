<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCommunicationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('communications', function (Blueprint $table) {
            $table->increments('id');
            $table->string('subject');
            $table->text('body');
            $table->string('sender');
            $table->integer('importance')->unsigned();
            $table->timestamp('send_at');
            $table->timestamp('archive_at');
            $table->boolean('is_draft');
            $table->integer('banner_id')->unsigned();
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('importance')->references('id')->on('communication_importance_levels');
            $table->foreign('banner_id')->references('id')->on('banners')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('communications');
    }
}
