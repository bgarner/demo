<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateAnalyticsAssetTypeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('analytics_asset_types', function (Blueprint $table) {
            $table->string('analytics_table_type')->after('type');
            $table->string('target_model')->after('type');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('analytics_asset_types', function (Blueprint $table) {
            $table->dropColumn('analytics_table_type');
            $table->dropColumn('target_model');
        });
    }
}
