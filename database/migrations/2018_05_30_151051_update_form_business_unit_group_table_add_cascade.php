<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateFormBusinessUnitGroupTableAddCascade extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('form_business_unit_group', function (Blueprint $table) {
            $table->dropForeign('form_business_unit_group_group_id_foreign');
            $table->foreign('group_id')->references('id')->on('form_usergroups')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('form_business_unit_group', function (Blueprint $table) {
            //
        });
    }
}
