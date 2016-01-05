<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNegativeTraitPlantPivotTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('negative_trait_plant_pivot', function (Blueprint $table) {
            $table->integer('negative_trait_id')->unsigned()->index();
            $table->foreign('negative_trait_id')->references('id')->on('negative_traits')->onDelete('cascade');
            $table->integer('plant_id')->unsigned()->index();
            $table->foreign('plant_id')->references('id')->on('plants')->onDelete('cascade');
            $table->primary(['negative_trait_id', 'plant_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('negative_trait_plant_pivot');
    }
}
