<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateActivitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('activities', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('user_id')->unsigned();
            $table->integer('target')->unsigned()->nullable();
            $table->string('title');
            $table->text('body')->nullable();
            $table->string('action_text')->nullable();
            $table->text('action_url')->nullable();

            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('target')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('activities');
    }
}
