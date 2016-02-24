<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePositiveTraitPlantPivotTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('positive_trait_plant_pivot', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('plant_positive_trait_id')->unsigned()->index();
            $table->foreign('plant_positive_trait_id')->references('id')->on('positive_traits')->onDelete('cascade');
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
        Schema::drop('positive_trait_plant_pivot');
    }
}
