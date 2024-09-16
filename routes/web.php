<?php

use App\Http\Controllers\CampaignController;
use App\Http\Controllers\MainController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', [MainController::class, 'welcome']);
Route::get('/home', [MainController::class, 'home'])->middleware('auth')->name('home');

Route::get('/campaign', [CampaignController::class, 'create'])->middleware('auth');
Route::get('/campaign/{id}', [CampaignController::class, 'show'])->middleware('auth');
Route::post('/campaign', [CampaignController::class, 'store'])->middleware('auth');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
