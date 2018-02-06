<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateDirtyNodesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('dirty_nodes', function (Blueprint $table) {
            $table->integer('sport_category')->after('event_or_team_name');
        });
    }


            // $table->increments('id');
            // $table->string('store_number', 255);
            // $table->string('store_name', 255);
            // $table->string('item_id', 255);
            // $table->string('desc', 255);
            // $table->string('UPC', 255);
            // $table->dateTime('start_date');
            // $table->integer('quantity')->unsigned();
            // $table->timestamps();

    BANNER  
    STORE   
    AVP 
    DM  
    STORENAME   
    NODE_KEY    
    ITEM_ID(SKU)    
    STYLECODE   
    STYLEDESC   
    COLOR   
    SIZENAME    
    UPCCODE 
    STARTDATE   
    WEEK    
    STARTTIME   
    ENDDATE 
    ENDTIME 
    QUANTITY    
    REASONCODE  
    Product 
    Status 
    Name 
    Department 
    Name 
    Sub 
    Department Name

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
