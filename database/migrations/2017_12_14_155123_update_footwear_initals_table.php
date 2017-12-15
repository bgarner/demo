<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateFootwearInitalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('footwear_initials', function (Blueprint $table) {
            $table->string('division', 255)->nullable()->after('store_number');
            $table->integer('codi_number')->nullable()->after('style_name');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('footwear_initials', function (Blueprint $table) {
            $table->dropColumn('division');
            $table->dropColumn('codi_number');
        });
    }
}
