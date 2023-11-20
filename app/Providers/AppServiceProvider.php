<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Services\AllService;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(AllService::class, function($app){
            return new AllService();
        });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
