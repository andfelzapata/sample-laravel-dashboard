<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePestSearchableNamePivotTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pest_searchable_name_pivot', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('pest_id')->unsigned()->index();
            $table->foreign('pest_id')->references('id')->on('pests')->onDelete('cascade');
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
        Schema::drop('pest_searchable_name_pivot');
    }
}
