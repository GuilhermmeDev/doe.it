<?php

use App\Http\Controllers\CampaignController;
use App\Http\Controllers\DonationController;
use App\Http\Controllers\MainController;
use App\Http\Controllers\ProfileController;
use App\Http\Middleware\CampaignOwner;
use Illuminate\Support\Facades\Route;

Route::get('/', [MainController::class, 'welcome']);


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/home', [MainController::class, 'home'])->name('home');
    Route::get('/info', [MainController::class, 'info'])->name('info');

    Route::get('/campaign', [CampaignController::class, 'create'])->name('campaign.create');
    Route::get('/campaign/{id}', [CampaignController::class, 'show'])->name('campaign.show');
    Route::post('/campaign', [CampaignController::class, 'store']);
    Route::delete('/campaign/{id}', [CampaignController::class, 'delete'])->name('campaign.delete');
    Route::get('/campaign/edit/{id}', [CampaignController::class, 'edit'])->name('campaign.edit');
    Route::put('/campaign/update/{id}', [CampaignController::class, 'update']);

    Route::get('/donate/{id}', [DonationController::class, 'donate'])->name('donation.donate');
    Route::post('/donation/{id}', [DonationController::class, 'store']);
    Route::get('/donation/{id}', [DonationController::class, 'show'])->name('donation.show');
    Route::get('/confirm/{id}', [DonationController::class, 'verify'])->middleware(CampaignOwner::class)->name('donation.verify');
    Route::post('/confirm/{id}', [DonationController::class, 'confirm']);
    Route::delete('/donation/{id}', [DonationController::class, 'delete']);

});

require __DIR__.'/auth.php';
