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
            $table->foreign('plant_type_id')->references('id')->on('plant_types')->onDelete('cascade');
            $table->string('common_name');
            $table->string('botanical_name');
            $table->integer('category_id')->unsigned();
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');
            $table->integer('subcategory_id')->unsigned();
            $table->foreign('subcategory_id')->references('id')->on('subcategories')->onDelete('cascade');
            $table->integer('zone_id')->unsigned();
            $table->foreign('zone_id')->references('id')->on('zones')->onDelete('cascade');
            $table->enum('tolerates',array());
            $table->enum('negative_characteristics',array());
            $table->enum('positive_characteristics',array());
            $table->integer('plant_growth_rate_id')->unsigned();
            $table->foreign('plant_growth_rate_id')->references('id')->on('plant_growth_rates')->onDelete('cascade');
            $table->integer('plant_average_size_id')->unsigned();
            $table->foreign('plant_average_size_id')->references('id')->on('plant_average_sizes')->onDelete('cascade');
            $table->integer('plant_maintenance_id')->unsigned();
            $table->foreign('plant_maintenance_id')->references('id')->on('plant_maintenance')->onDelete('cascade');
            $table->integer('plant_sun_exposure_id')->unsigned();
            $table->foreign('plant_sun_exposure_id')->references('id')->on('plant_sun_exposure')->onDelete('cascade');
            $table->integer('moisture')->unsigned();
            $table->text('description');
            $table->text('notes');
            $table->json('main_image'); // path, description, photo credit
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

        Schema::drop('plants');

    }
}
