<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateVideosTableAddThumbnail extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
     public function up()
     {
         Schema::table('videos', function (Blueprint $table) {
             $table->string('thumbnail');
         });
     }

     /**
      * Reverse the migrations.open
      *
      * @return void
      */
     public function down()
     {
         Schema::table('videos', function (Blueprint $table) {
             $table->dropColumn('thumbnail');
         });
     }
}
