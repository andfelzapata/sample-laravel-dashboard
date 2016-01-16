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
            $table->boolean('receive_emails');
            $table->boolean('receive_text_alerts');
            $table->boolean('google_ical_alerts');
            $table->boolean('receive_push_alerts');
            $table->boolean('show_latin_names_plants');
            $table->boolean('show_latin_names_culinary_plants');
            $table->boolean('show_latin_name_pests');
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
