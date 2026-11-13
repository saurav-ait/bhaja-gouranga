<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\MemberController;
use App\Http\Controllers\Admin\DonationController;
use App\Http\Controllers\Admin\DonationCategoryController;

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::middleware(['auth', 'role:super-admin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {

        Route::get('/dashboard', [DashboardController::class, 'index'])
            ->name('dashboard');

        Route::resource('members', MemberController::class);

        Route::resource('donations', DonationController::class)
        ->only(['index', 'create', 'store', 'show']);
        Route::post(
            'donations/{donation}/verify',
            [DonationController::class, 'verify']
        )->name('donations.verify');
        Route::get(
            'donations/{donation}/receipt',
            [DonationController::class, 'receipt']
        )->name('donations.receipt');
        Route::resource('donation-categories', DonationCategoryController::class);

    });

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
