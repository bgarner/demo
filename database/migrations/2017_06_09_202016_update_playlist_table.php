<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdatePlaylistTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('playlists', function (Blueprint $table) {
            $table->boolean('all_stores')->after('title');
            $table->dropForeign('playlists_banner_id_foreign');
            $table->dropColumn('banner_id');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('playlists', function (Blueprint $table) {
            $table->dropColumn('all_stores');
            $table->integer('banner_id')->unsigned();
            $table->foreign('banner_id')->references('id')->on('banners')->onDelete('cascade');
        });
    }
}
