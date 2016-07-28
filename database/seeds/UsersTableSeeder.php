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
        $this->createCompany();

        $this->createBlogger();

        $this->createDummyUsers();
    }

    /**
     * Create a company.
     */
    private function createCompany()
    {
        \App\User::forceCreate([
            'id'                         => 1,
            'type'                       => 'company',
            'name'                       => 'Rob Gloudemans',
            'email'                      => 'Rob_Gloudemans@hotmail.com',
            'password'                   => '$2y$10$AuEgaHt2sK3k4Kaya3NY3Oxqu.JXDYChuAcVqJOPZwcW5pZdzIU4u',
            'remember_token'             => null,
            'photo_url'                  => null,
            'title'                      => 'RobGloudemans Webdevelopment',
            'website'                    => 'http://robgloudemans.nl',
            'branch_id'                  => 7,
            'description'                => 'Professional Webdevelopment',
            'uses_two_factor_auth'       => 0,
            'authy_id'                   => null,
            'country_code'               => null,
            'phone'                      => null,
            'two_factor_reset_code'      => null,
            'current_team_id'            => null,
            'stripe_id'                  => 'cus_8sBdrRN75sQvX9',
            'current_billing_plan'       => 'bloggerlist-gold',
            'card_brand'                 => 'Visa',
            'card_last_four'             => '0002',
            'card_country'               => 'NL',
            'billing_address'            => 'Houtwolstraat 50',
            'billing_address_line_2'     => '',
            'billing_city'               => 'Mill',
            'billing_state'              => 'Noord-Brabant',
            'billing_zip'                => '5451HX',
            'billing_country'            => 'NL',
            'vat_id'                     => '',
            'extra_billing_information'  => null,
            'trial_ends_at'              => null,
            'address'                    => 'Houtwolstraat 50',
            'address_line_2'             => '',
            'city'                       => 'Mill',
            'state'                      => 'Noord-Brabant',
            'zip'                        => '5451HX',
            'country'                    => 'NL',
            'last_read_announcements_at' => '2016-07-23 16:38:18',
            'created_at'                 => '2016-07-23 16:38:18',
            'updated_at'                 => '2016-07-23 16:39:01',
        ]);

        DB::table('subscriptions')->insert([
            'id'            => 1,
            'user_id'       => 1,
            'name'          => 'default',
            'stripe_id'     => 'sub_8sBeesmLXJslUS',
            'stripe_plan'   => 'bloggerlist-gold',
            'quantity'      => 1,
            'trial_ends_at' => null,
            'ends_at'       => null,
            'created_at'    => '2016-07-23 16:38:25',
            'updated_at'    => '2016-07-23 16:38:25'
        ]);
    }

    /**
     * Create a blogger.
     */
    private function createBlogger()
    {
        \App\User::forceCreate([
            'id'                         => 2,
            'type'                       => 'blogger',
            'name'                       => 'Daniëlle Meulepas',
            'email'                      => 'dmeulepas@hotmail.com',
            'password'                   => '$2y$10$voVVMe2KsjUNYIqMa9RgA.QaXwIHzA8GbR2wBLmJpDkLIjQnJKLcC',
            'remember_token'             => null,
            'photo_url'                  => null,
            'title'                      => 'CupCakeCute',
            'website'                    => 'http://cupcakecute.nl',
            'branch_id'                  => 7,
            'description'                => 'Your Cupcake Heaven',
            'uses_two_factor_auth'       => 0,
            'authy_id'                   => null,
            'country_code'               => null,
            'phone'                      => null,
            'two_factor_reset_code'      => null,
            'current_team_id'            => null,
            'stripe_id'                  => null,
            'current_billing_plan'       => null,
            'card_brand'                 => null,
            'card_last_four'             => null,
            'card_country'               => null,
            'billing_address'            => null,
            'billing_address_line_2'     => null,
            'billing_city'               => null,
            'billing_state'              => null,
            'billing_zip'                => null,
            'billing_country'            => null,
            'vat_id'                     => null,
            'extra_billing_information'  => null,
            'trial_ends_at'              => null,
            'address'                    => '',
            'address_line_2'             => '',
            'city'                       => '',
            'state'                      => '',
            'zip'                        => '',
            'country'                    => 'US',
            'last_read_announcements_at' => '2016-07-23 16:38:18',
            'created_at'                 => '2016-07-23 16:38:18',
            'updated_at'                 => '2016-07-23 16:39:01',
        ]);
    }

    /**
     * Create a bunch of dummy users.
     */
    private function createDummyUsers()
    {
        $faker = app(\Faker\Generator::class);

        factory(\App\User::class)->times(25)->create(['type' => 'blogger'])->each(function (\App\User $user) use ($faker
        ) {
            $user->update([
                'title'       => $faker->name,
                'website'     => 'http://' . $faker->domainName,
                'branch_id'   => $faker->randomElement(range(1, 8)),
                'description' => $faker->paragraph(200),
            ]);
        });

        factory(\App\User::class)->times(25)->create(['type' => 'company'])->each(function (\App\User $user) use ($faker
        ) {
            $user->update([
                'title'       => $faker->company,
                'website'     => 'http://' . $faker->domainName,
                'branch_id'   => $faker->randomElement(range(1, 8)),
                'description' => $faker->paragraph(200),
            ]);
        });
    }
}
