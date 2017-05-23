<?php

namespace App\Providers;

use Carbon\Carbon;
use Laravel\Passport\Passport;
use Joselfonseca\LaravelApiTools\Auth\PassportAuthenticationProvider;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [

    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();
        Passport::routes();
        Passport::tokensExpireIn(Carbon::now()->addHours(10));
        Passport::refreshTokensExpireIn(Carbon::now()->addDays(3));
        app('Dingo\Api\Auth\Auth')->extend('passport', function ($app) {
            return app(PassportAuthenticationProvider::class);
        });
    }
}
