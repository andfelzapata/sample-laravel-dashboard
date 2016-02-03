<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAlertsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('alerts', function($table) {
            $table->increments('id');
            $table->string('name');
            $table->integer('zone_id')->unsigned();
            $table->foreign('zone_id')->references('id')->on('zones')->onDelete('cascade');
            $table->integer('alert_urgency_id')->unsigned();
            $table->foreign('alert_urgency_id')->references('id')->on('alert_urgencies')->onDelete('cascade');
            $table->integer('procedure_id')->unsigned();
            $table->foreign('procedure_id')->references('id')->on('procedures')->onDelete('cascade');
            $table->integer('plant_id')->unsigned();
            $table->foreign('plant_id')->references('id')->on('plants')->onDelete('cascade');
            $table->timestamp('start_date');
            $table->timestamp('end_date');
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
        Schema::drop('alerts');
    }
}
