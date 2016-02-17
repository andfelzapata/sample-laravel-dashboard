<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateJournalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('journals', function(Blueprint $table) {

            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->integer('status_id')->unsigned();
            $table->foreign('status_id')->references('id')->on('journal_status')->onDelete('cascade');
            $table->integer('plant_id')->unsigned();
            $table->foreign('plant_id')->references('id')->on('plants')->onDelete('cascade');
            $table->integer('pest_id')->unsigned();
            $table->foreign('pest_id')->references('id')->on('pests')->onDelete('cascade');
            $table->integer('procedure_id')->unsigned();
            $table->foreign('procedure_id')->references('id')->on('procedures')->onDelete('cascade');
            $table->integer('alert_id')->unsigned();
            $table->foreign('alert_id')->references('id')->on('alerts')->onDelete('cascade');
            $table->string('title');
            $table->text('content');
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
        Schema::drop('journals');
    }
}
