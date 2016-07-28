<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSocialmediaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('socialmedia', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('user_id')->unsigned();

            $table->string('facebook_id')->nullable();
            $table->string('facebook_name')->nullable();
            $table->string('facebook_token')->nullable();
            $table->timestamp('facebook_token_expires_at')->nullable();

            $table->string('twitter_id')->nullable();
            $table->string('twitter_name')->nullable();
            $table->string('twitter_token')->nullable();
            $table->timestamp('twitter_token_expires_at')->nullable();

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
        Schema::drop('socialmedia');
    }
}
