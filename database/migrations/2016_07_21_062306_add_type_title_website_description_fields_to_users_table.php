<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddTypeTitleWebsiteDescriptionFieldsToUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('type')->after('id');

            $table->text('description')->nullable()->after('photo_url');
            $table->string('website')->nullable()->after('photo_url');
            $table->string('title')->nullable()->after('photo_url');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['type', 'title', 'website', 'description']);
        });
    }
}
