<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        if ($this->app->environment('local')) {
            $this->app->register(\Barryvdh\LaravelIdeHelper\IdeHelperServiceProvider::class);
        }
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(\App\Contracts\ActivityRepository::class, \App\Activities\ActivityRepository::class);

        $this->app->bind(\Andreyco\Instagram\Client::class, function ($app) {
            return new \Andreyco\Instagram\Client([
                'apiKey'      => '99389b80793b4975bb7bee78f2d4c417',
                'apiSecret'   => '44628b74cd4d43c0a5750da95f548c26',
                'apiCallback' => 'http://thebloggerlist.dev/oauth/instagram',
                'scope'       => ['basic'],
            ]);
        });

        $this->app->bind(\Alaouy\Youtube\Youtube::class, function ($app) {
            return new \Alaouy\Youtube\Youtube($app['config']->get('youtube.KEY'));
        });
    }
}
