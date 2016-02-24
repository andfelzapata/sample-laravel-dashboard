<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePestPlantPivotTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pest_plant', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('pest_id')->unsigned()->index();
            $table->foreign('pest_id')->references('id')->on('pests')->onDelete('cascade');
            $table->integer('plant_id')->unsigned()->index();
            $table->foreign('plant_id')->references('id')->on('plants')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('pest_plant');
    }
}
