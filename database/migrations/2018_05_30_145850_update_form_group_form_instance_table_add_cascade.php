<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateFormGroupFormInstanceTableAddCascade extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('form_group_form_instance', function (Blueprint $table) {
            
            $table->dropForeign('form_group_form_instance_form_group_id_foreign');
            $table->foreign('form_group_id')->references('id')->on('form_usergroups')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('form_group_form_instance', function (Blueprint $table) {
            //
        });
    }
}
