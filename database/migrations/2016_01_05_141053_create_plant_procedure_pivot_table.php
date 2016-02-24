<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePlantProcedurePivotTable extends Migration
{
    /**
     * Run the mi   grations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('plant_procedure', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('plant_id')->unsigned()->index();
            $table->foreign('plant_id')->references('id')->on('plants')->onDelete('cascade');
            $table->integer('procedure_id')->unsigned()->index();
            $table->foreign('procedure_id')->references('id')->on('procedures')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('plant_procedure');
    }
}
