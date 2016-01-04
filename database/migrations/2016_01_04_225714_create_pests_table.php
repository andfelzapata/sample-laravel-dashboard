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
            $table->integer('subcategory_id')->unsigned();
            $table->integer('severity_id')->unsigned();
            $table->text('pest_description');
            $table->text('damage_description');
            $table->json('main_image'); // path, description, photo credit
            $table->json('main_video'); // path, description, photo credit
            $table->integer('sponsor_id')->unsigned();
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
