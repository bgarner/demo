<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateAlertstargetTableChangeStoreidDatatype extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('alerts_target', function (Blueprint $table) {
            DB::statement('ALTER TABLE alerts_target MODIFY COLUMN store_id VARCHAR(255)');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('alerts_target', function (Blueprint $table) {
            DB::statement('ALTER TABLE alerts_target MODIFY COLUMN store_id INT(11)');
        });
    }
}
