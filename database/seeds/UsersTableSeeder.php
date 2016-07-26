<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\User::forceCreate([
            'id' => 1,
            'type' => 'company',
            'name' => 'Rob Gloudemans',
            'email' => 'Rob_Gloudemans@hotmail.com',
            'password' => '$2y$10$AuEgaHt2sK3k4Kaya3NY3Oxqu.JXDYChuAcVqJOPZwcW5pZdzIU4u',
            'remember_token' => NULL,
            'photo_url' => NULL,
            'title' => 'RobGloudemans Webdevelopment',
            'website' => 'http://robgloudemans.nl',
            'branch_id' => 7,
            'description' => 'Professional Webdevelopment',
            'uses_two_factor_auth' => 0,
            'authy_id' => NULL,
            'country_code' => NULL,
            'phone' => NULL,
            'two_factor_reset_code' => NULL,
            'current_team_id' => NULL,
            'stripe_id' => 'cus_8sBdrRN75sQvX9',
            'current_billing_plan' => 'bloggerlist-gold',
            'card_brand' => 'Visa',
            'card_last_four' => '0002',
            'card_country' => 'NL',
            'billing_address' => 'Houtwolstraat 50',
            'billing_address_line_2' => '',
            'billing_city' => 'Mill',
            'billing_state' => 'Noord-Brabant',
            'billing_zip' => '5451HX',
            'billing_country' => 'NL',
            'vat_id' => '',
            'extra_billing_information' => NULL,
            'trial_ends_at' => NULL,
            'address' => 'Houtwolstraat 50',
            'address_line_2' => '',
            'city' => 'Mill',
            'state' => 'Noord-Brabant',
            'zip' => '5451HX',
            'country' => 'NL',
            'last_read_announcements_at' => '2016-07-23 16:38:18',
            'created_at' => '2016-07-23 16:38:18',
            'updated_at' => '2016-07-23 16:39:01',
        ]);

        DB::table('subscriptions')->insert([
            'id' => 1,
            'user_id' => 1,
            'name' => 'default',
            'stripe_id' => 'sub_8sBeesmLXJslUS',
            'stripe_plan' => 'bloggerlist-gold',
            'quantity' => 1,
            'trial_ends_at' => NULL,
            'ends_at' => NULL,
            'created_at' => '2016-07-23 16:38:25',
            'updated_at' => '2016-07-23 16:38:25'
        ]);

        \App\User::forceCreate([
            'id' => 2,
            'type' => 'blogger',
            'name' => 'Daniëlle Meulepas',
            'email' => 'dmeulepas@hotmail.com',
            'password' => '$2y$10$voVVMe2KsjUNYIqMa9RgA.QaXwIHzA8GbR2wBLmJpDkLIjQnJKLcC',
            'remember_token' => NULL,
            'photo_url' => NULL,
            'title' => 'CupCakeCute',
            'website' => 'http://cupcakecute.nl',
            'branch_id' => 7,
            'description' => 'Your Cupcake Heaven',
            'uses_two_factor_auth' => 0,
            'authy_id' => NULL,
            'country_code' => NULL,
            'phone' => NULL,
            'two_factor_reset_code' => NULL,
            'current_team_id' => NULL,
            'stripe_id' => NULL,
            'current_billing_plan' => NULL,
            'card_brand' => NULL,
            'card_last_four' => NULL,
            'card_country' => NULL,
            'billing_address' => NULL,
            'billing_address_line_2' => NULL,
            'billing_city' => NULL,
            'billing_state' => NULL,
            'billing_zip' => NULL,
            'billing_country' => NULL,
            'vat_id' => NULL,
            'extra_billing_information' => NULL,
            'trial_ends_at' => NULL,
            'address' => '',
            'address_line_2' => '',
            'city' => '',
            'state' => '',
            'zip' => '',
            'country' => 'US',
            'last_read_announcements_at' => '2016-07-23 16:38:18',
            'created_at' => '2016-07-23 16:38:18',
            'updated_at' => '2016-07-23 16:39:01',
        ]);

    }
}
