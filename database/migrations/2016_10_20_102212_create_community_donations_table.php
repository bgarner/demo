<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCommunityDonationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('community_donations', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('store_number');
            $table->string('employee_name');
            $table->string('employee_number');
            $table->string('event_or_team_name')->nullable();
            $table->string('recipient_organization');
            $table->string('recipient_name');
            $table->string('recipient_phone')->nullable();
            $table->string('recipient_email')->nullable();
            $table->string('receipt_date');
            $table->string('event_date')->nullable();
            $table->string('event_location')->nullable();
            $table->boolean('dm_approval');
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
        Schema::drop('community_donations');
    }
}
