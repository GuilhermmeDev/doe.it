<?php

use App\Http\Controllers\CampaignController;
use App\Http\Controllers\DonationController;
use App\Http\Controllers\MainController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', [MainController::class, 'welcome']);

Route::middleware('auth', 'verified')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::post('/profile/send-reset-link', [ProfileController::class, 'sendResetLink'])->name('profile.password.send');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/home', [MainController::class, 'home'])->name('home');

    Route::get('/info', [MainController::class, 'info'])->name('info');

    Route::get('/campaign', [CampaignController::class, 'create'])->name('campaign.create');
    Route::get('/campaign/{id}', [CampaignController::class, 'show'])->name('campaign.show');
    Route::post('/campaign', [CampaignController::class, 'store']);
    Route::delete('/campaign/{id}', [CampaignController::class, 'delete'])->name('campaign.delete');
    Route::get('/campaign/edit/{id}', [CampaignController::class, 'edit'])->name('campaign.edit');
    Route::put('/campaign/update/{id}', [CampaignController::class, 'update']);
    Route::post('/campaign/invite', [CampaignController::class, 'invite'])->name('campaign.invite');
    Route::get('/campaign/accept/{token}', [CampaignController::class, 'accept'])->name('campaign.accept');
    Route::get('/campaign/decline/{token}', [CampaignController::class, 'decline'])->name('campaign.decline');
    Route::delete('/campaign/{campaign}/validator/{user}', [CampaignController::class, 'removeValidator'])
        ->name('campaigns.removeValidator')
        ->middleware('auth');

    Route::get('/donate/{id}', [DonationController::class, 'donate'])->name('donation.donate');
    Route::post('/donation/{id}', [DonationController::class, 'store']);
    Route::get('/donation/{id}', [DonationController::class, 'show'])->name('donation.show');
    Route::get('/confirm/{id}', [DonationController::class, 'verify']);
    Route::post('/confirm/{id}', [DonationController::class, 'confirm']);
    Route::delete('/donation/{id}', [DonationController::class, 'delete']);
    Route::get('/history', [DonationController::class, 'historic']);

    Route::patch('/cpf', [ProfileController::class, 'registerCpf']);
});

require __DIR__ . '/auth.php';
