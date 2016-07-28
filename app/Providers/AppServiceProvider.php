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

        $this->app->bind(\Abraham\TwitterOAuth\TwitterOAuth::class, function ($app) {
            return new \Abraham\TwitterOAuth\TwitterOAuth('5IWiMLSQMcyNGMxQn87Sm7IYE', '0huTLoGLftx9hqfwR1ceoYDmLG7wj93mu3uOPS6EtXhAYOUQOi');
        });
    }
}
