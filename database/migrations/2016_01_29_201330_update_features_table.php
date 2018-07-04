<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateFeaturesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('features', function (Blueprint $table) {
            $table->integer("order")->after("banner_id");
            $table->softDeletes();
            $table->timestamps();
            $table->string('tile_label')->after('title');
            $table->string('thumbnail');
            $table->integer('update_type_id')->unsigned();
            $table->string('update_frequency');
            $table->foreign('update_type_id')->references('id')->on('feature_latest_update_types')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('features', function (Blueprint $table) {
            //
        });
    }
}
