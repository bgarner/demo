<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUrgentNoticeFoldersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('urgent_notice_folders', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('urgent_notice_id')->unsigned();
            $table->integer('folder_id')->unsigned();
            $table->foreign('urgent_notice_id')->references('id')->on('urgent_notices')->onDelete('cascade');
            $table->foreign('folder_id')->references('id')->on('folder_ids')->onDelete('cascade');
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
        Schema::drop('urgent_notice_folders');
    }
}
