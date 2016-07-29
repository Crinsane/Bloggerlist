<?php

namespace App\Providers;

use Carbon\Carbon;
use Laravel\Spark\Contracts\Repositories\UserRepository;
use Laravel\Spark\Spark;
use Laravel\Spark\Events\Profile\ContactInformationUpdated;
use Laravel\Spark\Providers\AppServiceProvider as ServiceProvider;
use Laravel\Spark\Contracts\Interactions\Settings\Profile\UpdateContactInformation;

class SparkServiceProvider extends ServiceProvider
{
    /**
     * Your application and company details.
     *
     * @var array
     */
    protected $details = [
        'vendor' => 'Bloggermedia',
        'product' => 'The Bloggerlist',
        'street' => 'Toernooiveld 200',
        'location' => '6525 EC Nijmegen',
        'phone' => '+31 (24) 3553318',
    ];

    /**
     * The address where customer support e-mails should be sent.
     *
     * @var string
     */
    protected $sendSupportEmailsTo = 'support@thebloggerlist.com';

    /**
     * All of the application developer e-mail addresses.
     *
     * @var array
     */
    protected $developers = [
        'Rob_Gloudemans@hotmail.com',
    ];

    /**
     * Indicates if the application will expose an API.
     *
     * @var bool
     */
    protected $usesApi = true;

    /**
     * Finish configuring Spark for the application.
     *
     * @return void
     */
    public function booted()
    {
        Spark::collectEuropeanVat('NL');

        \Laravel\Cashier\Cashier::useCurrency('eur', '€');

        Spark::useStripe()
//            ->noCardUpFront()
            ->trialDays(10);

        Spark::freePlan('Blogger')
            ->features([
                'View all available project', 'Create a personal project', 'Communicate with other bloggers'
            ]);

//        Spark::plan('Company Silver', 'bloggerlist-silver')
//            ->price(10)
//            ->features([
//                'Create project for our bloggers', 'Max. 5 projects', 'Search through are list of bloggers'
//            ]);

        Spark::plan('Company', 'bloggerlist-gold')
            ->price(20)
            ->features([
                'Create project for our bloggers', 'Search through are list of bloggers', 'Promote your events'
            ]);
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        Spark::createUsersWith(function ($request) {
            $user = Spark::user();

            $data = $request->all();

            $type = $data['plan'] === 'free' ? 'blogger' : 'company';

            $user->forceFill([
                'name' => $data['name'],
                'email' => $data['email'],
                'type' => $type,
                'password' => bcrypt($data['password']),
                'last_read_announcements_at' => Carbon::now(),
                'trial_ends_at' => Carbon::now()->addDays(Spark::trialDays()),
                'address' => $data['address'],
                'address_line_2' => $data['address_line_2'],
                'city' => $data['city'],
                'state' => $data['state'],
                'zip' => $data['zip'],
                'country' => $data['country'],
            ])->save();

            return $user;
        });

        Spark::swap(UpdateContactInformation::class . '@handle', function ($user, $data) {
            $user->forceFill([
                'name' => $data['name'],
                'email' => $data['email'],
                'address' => $data['address'],
                'address_line_2' => $data['address_line_2'],
                'city' => $data['city'],
                'state' => $data['state'],
                'zip' => $data['zip'],
                'country' => $data['country'],
            ])->save();

            event(new ContactInformationUpdated($user));

            return $user;
        });

        Spark::swap('UserRepository@current', function () {
            $user = $this->app->make(UserRepository::class)->current();

            return $user ? $user->load('subscribedProjects', 'socialMedia') : null;
        });
    }
}
