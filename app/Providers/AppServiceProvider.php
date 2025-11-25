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
        // Define authorization gates for role-based access
        Gate::define('admin-only', function ($user) {
            return $user->isAdmin();
        });

        Gate::define('member-only', function ($user) {
            return $user->isMember();
        });
    }
}
