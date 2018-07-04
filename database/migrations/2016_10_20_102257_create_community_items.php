<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCommunityItems extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('community_donated_items', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('donation_type');    
            $table->string('title');
            $table->text('description');
            $table->float('value', 8, 2);
            $table->string('style_number')->nullable();
            $table->string('upc')->nullable();
            $table->nullableTimestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('community_donated_items');
    }
}
