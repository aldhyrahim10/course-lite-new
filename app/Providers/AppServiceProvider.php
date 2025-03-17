<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Gate::define('administrator', function ($user) {
            return $user->hasRole('administrator');
        });

        Gate::define('instructor', function ($user) {
            return $user->hasRole('instructor');
        });

        Gate::define('student', function ($user) {
            return $user->hasRole('student');
        });
    }
}
