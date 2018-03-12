<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateFormStatusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('form_status_code', function (Blueprint $table) {
            $table->dropColumn('status_code');
            $table->string('store_status')->after('form_id');
            $table->string('admin_status')->after('store_status');
            $table->string('icon')->after('admin_status');
            $table->string('colour')->after('icon');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('form_status_code', function (Blueprint $table) {
            //
        });
    }
}
