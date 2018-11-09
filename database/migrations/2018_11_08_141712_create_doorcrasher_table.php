<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDoorcrasherTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('doorcrasher', function (Blueprint $table) {
            $table->increments('id');
            $table->string('store_style')->nullable();
            $table->string('store_number')->nullable();
            $table->string('store_name')->nullable();
            $table->string('dpt_number')->nullable();
            $table->string('dpt_name')->nullable();
            $table->string('sdpt_number')->nullable();
            $table->string('sdpt_name')->nullable();
            $table->string('cls_number')->nullable();
            $table->string('cls_name')->nullable();
            $table->string('scls_number')->nullable();
            $table->string('scls_name')->nullable();
            $table->string('brand')->nullable();
            $table->string('style_number')->nullable();
            $table->string('style_name')->nullable();
            $table->string('clr_code')->nullable();
            $table->string('clr_name')->nullable();
            $table->string('oh_qty')->nullable();
            $table->string('oh_avail_qty')->nullable();
            $table->string('it_qty')->nullable();
            $table->string('ootr_qty')->nullable();
            $table->string('ooasn_qty')->nullable();
            $table->string('oopo_qty')->nullable();
            $table->string('oh_rtl')->nullable();
            $table->string('oh_avail_rtl')->nullable();
            $table->string('it_rtl')->nullable();
            $table->string('ootr_rtl')->nullable();
            $table->string('ooasn_rtl')->nullable();
            $table->string('oopo_rtl')->nullable();
            $table->string('oh_avg_rtl')->nullable();
            $table->string('org_div')->nullable();
            $table->string('org_div_style')->nullable();
            $table->string('store_format')->nullable();
            $table->string('flyer_page_chek')->nullable();
            $table->string('ad_box_chek')->nullable();
            $table->string('ad_min_chek')->nullable();
            $table->string('flyer_page_atmo')->nullable();
            $table->string('ad_box_atmo')->nullable();
            $table->string('ad_min_atmo')->nullable();
            $table->string('flyer_page')->nullable();
            $table->string('ad_box')->nullable();
            $table->string('ad_min')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('doorcrasher');
    }
}
