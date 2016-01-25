<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProcedureSearchableNamePivotTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('procedure_searchable_name_pivot', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('procedure_id')->unsigned()->index();
            $table->foreign('procedure_id')->references('id')->on('procedures')->onDelete('cascade');
            $table->integer('searchable_name_id')->unsigned()->index();
            $table->foreign('searchable_name_id')->references('id')->on('searchable_names')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('procedure_searchable_name_pivot');
    }
}
