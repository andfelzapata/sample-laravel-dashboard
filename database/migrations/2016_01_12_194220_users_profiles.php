<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UsersProfiles extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users_profiles', function (Blueprint $table) {
            $table->integer('user_id')->unsigned();
            $table->integer('profile_id')->unsigned();
            $table->primary(array('user_id','profile_id'));
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('profile_id')->references('id')->on('profiles')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('users_profiles');
    }
}
