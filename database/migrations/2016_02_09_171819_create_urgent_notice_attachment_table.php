<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUrgentNoticeAttachmentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('urgent_notice_attachment', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('urgent_notice_id')->unsigned();
            $table->integer('attachment_id')->unsigned();
            $table->timestamps();
            $table->foreign('urgent_notice_id')->references('id')->on('urgent_notices')->onDelete('cascade');
        });
    }

    /**`
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('urgent_notice_attachment');
    }
}
