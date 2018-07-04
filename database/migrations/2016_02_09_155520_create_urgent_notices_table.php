<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUrgentNoticesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('urgent_notices', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->integer('banner_id')->unsigned();
            $table->mediumText('title');    
            $table->longText('description');
            $table->integer('attachment_type_id')->unsigned();
            $table->date('start');
            $table->date('end')->nullable();
            $table->timestamps();
            $table->foreign('banner_id')->references('id')->on('banners')->onDelete('cascade');
            $table->foreign('attachment_type_id')->references('id')->on('urgent_notice_attachment_types')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('urgent_notices');
    }
}
