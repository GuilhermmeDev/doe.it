<?php

namespace App\Providers;

use App\Models\Campaign;
use App\Models\User;
use App\Models\Donation;
use App\Models\CampaignValidatorUser;
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
        Gate::define('auth-donation', function (User $user, Campaign $campaign, Donation $donation){
            return $campaign->user_id === $user->id || (
            CampaignValidatorUser::where('campaign_id', $campaign->id)
                ->where('user_id', $user->id)
                ->where('status', 'accepted')
                ->exists() &&
                    Donation::where([['id', $donation->id],['user_id','!=', $user->id], ['campaign_id', $campaign->id]])->exists()
            );
        });

        Gate::define('verify-cpf', function (User $user) {
            return $user->CPF !== null;
        });
    }
}
