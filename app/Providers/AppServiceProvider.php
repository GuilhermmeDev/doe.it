<?php

namespace App\Providers;

use App\Models\Campaign;
use App\Models\CampaignValidatorUser;
use App\Models\Donation;
use App\Models\User;
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
        Gate::define('auth-donation', function ($user, $campaign, $donation) {
            return $campaign->user_id === $user->id || (
                CampaignValidatorUser::where('campaign_id', $campaign->id)
                ->where('user_id', $user->id)
                ->where('status', 'accepted')
                ->exists() &&
                Donation::where([['id', $donation->id], ['user_id', '!=', $user->id], ['campaign_id', $campaign->id]])->exists()
            );
        });

        Gate::define('verify-cpf', function ($user) {
            return $user->CPF !== null;
        });

        Gate::define('owner-qrcode', function (User $user, Donation $donation) {
            return $user->id === Donation::findOrFail($donation->id)->user_id;
        });
    }
}
