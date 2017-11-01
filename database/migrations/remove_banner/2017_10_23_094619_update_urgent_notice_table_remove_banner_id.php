<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateUrgentNoticeTableRemoveBannerId extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('urgent_notices', function (Blueprint $table) {
            $table->dropForeign('urgent_notices_banner_id_foreign');
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
        Schema::table('urgent_notices', function (Blueprint $table) {
            $table->integer('banner_id')->unsigned()->default(1);
            $table->foreign('banner_id')->references('id')->on('banners');
        });
    }
}
