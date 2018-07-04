<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateDocumentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table("documents", function ($table) {
            $table->string('original_extension')->after('original_filename');
            $table->string('start');
            $table->string('end');
            $table->integer('banner_id')->unsigned()->after('description');
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
        Schema::table("documents", function ($table) {
            $table->dropColumn('original_extension');
            $table->dropColumn('start');
            $table->dropColumn('end');
            $table->dropForeign('documents_banner_id_foreign');
            $table->dropColumn('banner_id');
        });
    }
}
