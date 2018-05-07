<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateDirtyNodeAddDomResponseCode extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('dirty_nodes', function (Blueprint $table) {
            $table->mediumText('API_response')->after('updated_at');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('dirty_nodes', function (Blueprint $table) {
            $table->dropColumn('API_response');
        });
    }
}
