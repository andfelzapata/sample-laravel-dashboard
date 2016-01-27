<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProceduresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('procedures', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->integer('category_id')->unsigned();
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');
            $table->integer('subcategory_id')->unsigned();
            $table->foreign('subcategory_id')->references('id')->on('subcategories')->onDelete('cascade');
            $table->integer('urgency_id')->unsigned();
            $table->foreign('urgency_id')->references('id')->on('procedure_urgencies')->onDelete('cascade');
            $table->text('how');
            $table->text('why');
            $table->json('main_image'); // path, description, photo credit
            $table->json('main_video'); // path, description, photo credit
            $table->integer('sponsor_id')->unsigned();
            $table->foreign('sponsor_id')->references('id')->on('sponsors')->onDelete('cascade');
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
        Schema::drop('procedures');
    }
}
