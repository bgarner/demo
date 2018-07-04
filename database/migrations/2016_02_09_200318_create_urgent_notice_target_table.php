<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUrgentNoticeTargetTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('urgent_notice_target', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('urgent_notice_id')->unsigned();
            $table->integer('store_id')->unsigned();
            $table->boolean('is_read');
            $table->timestamps();
            $table->foreign('urgent_notice_id')->references('id')->on('urgent_notices')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('urgent_notice_target');
    }
}
