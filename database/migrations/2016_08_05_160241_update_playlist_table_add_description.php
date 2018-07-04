<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdatePlaylistTableAddDescription extends Migration
{
    public function up()
    {
        Schema::table('playlists', function (Blueprint $table) {
            $table->string('description');
        });
    }

    /**
     * Reverse the migrations.open
     *
     * @return void
     */
    public function down()
    {
        Schema::table('playlists', function (Blueprint $table) {
            $table->dropColumn('description');
        });
    }
}
