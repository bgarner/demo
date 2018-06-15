<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class DropDistrictRegionRegionIdForeignFromDistrictRegionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('district_region', function (Blueprint $table) {
            $table->dropForeign('district_region_region_id_foreign');
            $table->dropForeign('district_region_district_id_foreign');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('district_region', function (Blueprint $table) {
            //
        });
    }
}
