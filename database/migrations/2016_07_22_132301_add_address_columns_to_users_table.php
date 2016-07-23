<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddAddressColumnsToUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('country', 2)->nullable()->after('trial_ends_at');
            $table->string('zip', 25)->nullable()->after('trial_ends_at');
            $table->string('state')->nullable()->after('trial_ends_at');
            $table->string('city')->nullable()->after('trial_ends_at');
            $table->string('address_line_2')->nullable()->after('trial_ends_at');
            $table->string('address')->nullable()->after('trial_ends_at');
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
            $table->dropColumn(['address', 'address_line_2', 'city', 'state', 'zip', 'country']);
        });
    }
}
