<?php

namespace App\Providers;

use App\Models\Campaign;
use App\Models\User;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Gate;

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
        Gate::define('auth-donation', function (User $user, Campaign $campaign){
            return $campaign->user_id === auth()->user()->id; 
        });

        Gate::define('verify-cpf', function (User $user) {
            return $user->CPF !== null;
        });
    }
}
