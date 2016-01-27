<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pests', function (Blueprint $table) {
            $table->increments('id');
            $table->string('common_name');
            $table->string('latin_name');
            $table->integer('category_id')->unsigned();
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');
            $table->integer('subcategory_id')->unsigned();
            $table->foreign('subcategory_id')->references('id')->on('subcategories')->onDelete('cascade');
            $table->integer('severity_id')->unsigned();
            $table->foreign('severity_id')->references('id')->on('pest_severities')->onDelete('cascade');
            $table->text('pest_description');
            $table->text('damage_description');
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
        Schema::drop('pests');
    }
}
