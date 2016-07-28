<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSocialmediaStatsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('socialmedia_stats', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('user_id')->unsigned();
            $table->integer('facebook')->unsigned()->nullable();
            $table->integer('twitter')->unsigned()->nullable();
            $table->integer('instagram')->unsigned()->nullable();
            $table->integer('youtube')->unsigned()->nullable();

            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('socialmedia_stats');
    }
}
