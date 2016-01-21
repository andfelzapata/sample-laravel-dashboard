<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('settings', function (Blueprint $table) {
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->boolean('receive_emails')->default(false);
            $table->boolean('receive_text_alerts')->default(false);
            $table->boolean('google_ical_alerts')->default(false);
            $table->boolean('receive_push_alerts')->default(false);
            $table->boolean('show_latin_names_plants')->default(false);
            $table->boolean('show_latin_names_culinary_plants')->default(false);
            $table->boolean('show_latin_names_pests')->default(false);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('settings', function (Blueprint $table) {
            $table->drop('settings');
        });
    }
}
