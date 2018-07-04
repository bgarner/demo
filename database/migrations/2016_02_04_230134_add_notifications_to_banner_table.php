<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddNotificationsToBannerTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('banners', function (Blueprint $table) {
            $table->integer('update_type_id')->unsigned();
            $table->string('update_window_size');
            $table->foreign('update_type_id')->references('id')->on('feature_latest_update_types');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('banners', function (Blueprint $table) {
            $table->dropForeign('banners_update_type_id_foreign');
            $table->dropColumn('update_type_id');
            $table->dropColumn('update_window_size');
        });
    }
}
