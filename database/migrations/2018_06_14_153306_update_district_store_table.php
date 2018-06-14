<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateDistrictStoreTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::table('district_store')->truncate();

        Schema::table('district_store', function (Blueprint $table) {
            $table->dropForeign('district_store_district_id_foreign');
            $table->dropForeign('district_store_store_id_foreign');
        });
    }
    
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('district_store', function (Blueprint $table) {
            //
        });
    }
}
