<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use App\Models\Communication\CommunicationTarget;

class UpdateCommunicationTargetTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('communications_target_new', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('communication_id')->unsigned();
            $table->string('store_id');
            $table->boolean('is_read');
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('communication_id')->references('id')->on('communications')->onDelete('cascade');
        });

        $communication_targets = CommunicationTarget::all();
        foreach ($communication_targets as $item) 
        {
            \DB::table('communications_target_new')->insert($item->toArray());
        }

        Schema::drop('communications_target');

        Schema::rename('communications_target_new', 'communications_target');

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::create('communications_target_old', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('communication_id');
            $table->string('store_id');
            $table->boolean('is_read');
            $table->timestamps();
            $table->softDeletes();
        });

        $communication_targets = CommunicationTarget::all();
        foreach ($communication_targets as $item) 
        {
            \DB::table('communications_target_old')->insert($item->toArray());
        }

        Schema::drop('communications_target');
        Schema::rename('communications_target_old', 'communications_target');
    }
}
