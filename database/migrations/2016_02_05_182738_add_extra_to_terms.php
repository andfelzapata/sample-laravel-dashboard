<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddExtraToTerms extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('terms', function (Blueprint $table) {
            $table->json('image');
            $table->string('pronunciation',32);
            $table->string('meaning',140);
            $table->string('category_type',32);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('terms', function (Blueprint $table) {
            $table->dropColumn('image');
            $table->dropColumn('pronunciation');
            $table->dropColumn('meaning');
        });
    }
}
