<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePestProcedurePivotTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pest_procedure', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('pest_id')->unsigned()->index();
            $table->foreign('pest_id')->references('id')->on('pests')->onDelete('cascade');
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
        Schema::drop('pest_procedure');
    }
}
