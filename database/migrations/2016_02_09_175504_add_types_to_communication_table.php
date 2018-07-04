<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddTypesToCommunicationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('communications', function (Blueprint $table) {
            $table->integer('communication_type_id')->after('importance')->unsigned();
            $table->foreign('communication_type_id')->references('id')->on('communication_types');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('communications', function (Blueprint $table) {
            $table->dropForeign('communications_communication_type_id_foreign');
            $table->dropColumn('communication_type_id');
        });
    }
}
