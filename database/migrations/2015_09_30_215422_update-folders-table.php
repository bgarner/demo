<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateFoldersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
         Schema::table('folders', function ($table) {
            $table->boolean('has_child');
            $table->boolean('is_child');
            $table->boolean('has_weeks')->after('is_child');
            $table->integer('week_window_size')->after('has_weeks');
            $table->integer('banner_id')->unsigned()->after('week_window_size');
            $table->timestamp('last_activity_at');
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
        Schema::table('folders', function ($table) {
            $table->removeColumn('has_child');
            $table->dropColumn('is_child');
            $table->dropColumn('has_weeks');
            $table->dropColumn('week_window_size');
            $table->dropForeign('folders_banner_id_foreign');
            $table->dropColumn('banner_id');
            $table->dropColumn('last_activity_at');
        });

    }
}
