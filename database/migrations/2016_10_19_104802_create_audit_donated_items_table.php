<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAuditDonatedItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('audit_donated_items', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->integer('audit_id'); //references audits table
            $table->integer('item_type'); //from audit_donation_types table
            $table->string('item_name');
            $table->string('item_style_number');
            $table->string('item_upc');
            $table->text('item_description');
            $table->string('item_retail_value');
            $table->timestamps();
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
        Schema::drop('audit_donated_items');
    }
}
