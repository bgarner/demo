<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdatePackagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('packages', function (Blueprint $table) {
            $table->integer('start')->after('package_name');
            $table->integer('end')->after('start');
            $table->integer('banner_id')->unsigned()->after('is_hidden');
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
        Schema::table('packages', function (Blueprint $table) {
            $table->dropForeign('packages_banner_id_foreign');
            $table->dropColumn('banner_id');
            $table->dropColumn('start');
            $table->dropColumn('end');
        });
    }
}
