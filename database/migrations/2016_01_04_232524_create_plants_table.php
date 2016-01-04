<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePlantsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('plants', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('plant_type_id')->unsigned();
            $table->string('common_name');
            $table->string('botanical_name');
            $table->integer('category_id')->unsigned();
            $table->integer('subcategory_id')->unsigned();
            $table->integer('zone_id')->unsigned();
            $table->enum('tolerates');
            $table->enum('negative_characteristics');
            $table->enum('positive_characteristics');
            $table->integer('plant_growth_rate_id')->unsigned();
            $table->integer('plant_average_size_id')->unsigned();
            $table->integer('plant_maintenance_id')->unsigned();
            $table->integer('plant_sun_exposure_id')->unsigned();
            $table->integer('moisture')->unsigned();
            $table->text('description');
            $table->text('notes');
            $table->json('main_image'); // path, description, photo credit
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
        Schema::drop('plants');
    }
}
