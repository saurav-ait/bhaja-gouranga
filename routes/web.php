<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\MemberController;
use App\Http\Controllers\Admin\DonationController;
use App\Http\Controllers\Admin\DonationCategoryController;
use App\Http\Controllers\Admin\DonorController;
use App\Http\Controllers\Admin\ExpenseController;

Route::get('/', function () {
    return view('welcome');
})->name('home');


Route::middleware(['auth'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {

    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])
        ->middleware('permission:dashboard.view')
        ->name('dashboard');

    // Members
    // View Members
    // Create Members
    Route::resource('members', MemberController::class)
        ->only(['create', 'store'])
        ->middleware('permission:members.create');

    Route::resource('members', MemberController::class)
        ->only(['index', 'show'])
        ->middleware('permission:members.view');

    // Edit Members
    Route::resource('members', MemberController::class)
        ->only(['edit', 'update'])
        ->middleware('permission:members.edit');

    // Delete Members
    Route::resource('members', MemberController::class)
        ->only(['destroy'])
        ->middleware('permission:members.delete');

    // Donations
    Route::resource('donations', DonationController::class)
        ->only(['create', 'store'])
        ->middleware('permission:donations.create');
    Route::resource('donations', DonationController::class)
        ->only(['index', 'show'])
        ->middleware('permission:donations.view');

    // Verify Donation
    Route::post(
        'donations/{donation}/verify',
        [DonationController::class, 'verify']
    )->middleware('permission:donations.verify')
        ->name('donations.verify');

    // Donation Receipt
    Route::get(
        'donations/{donation}/receipt',
        [DonationController::class, 'receipt']
    )->middleware('permission:donations.receipt')
        ->name('donations.receipt');

    // Donation Categories
    Route::resource('donation-categories', 
        DonationCategoryController::class)
        ->middleware('permission:donation-categories.manage');

    // Donor Management Routes

    Route::get('donors', [DonorController::class, 'index'])
        ->middleware('permission:donors.view')
        ->name('donors.index');

    Route::get('donors/create', [DonorController::class, 'create'])
        ->middleware('permission:donors.create')
        ->name('donors.create');

    Route::post('donors', [DonorController::class, 'store'])
        ->middleware('permission:donors.create')
        ->name('donors.store');

    Route::get('donors/{donor}', [DonorController::class, 'show'])
        ->middleware('permission:donors.view')
        ->name('donors.show');

    Route::get('donors/{donor}/edit', [DonorController::class, 'edit'])
        ->middleware('permission:donors.edit')
        ->name('donors.edit');

    Route::put('donors/{donor}', [DonorController::class, 'update'])
        ->middleware('permission:donors.edit')
        ->name('donors.update');

    Route::delete('donors/{donor}', [DonorController::class, 'destroy'])
        ->middleware('permission:donors.delete')
        ->name('donors.destroy');

    // Expense Management

    Route::get('expenses', [ExpenseController::class, 'index'])
        ->middleware('permission:finance.view')
        ->name('expenses.index');

    Route::get('expenses/create', [ExpenseController::class, 'create'])
        ->middleware('permission:finance.manage')
        ->name('expenses.create');

    Route::post('expenses', [ExpenseController::class, 'store'])
        ->middleware('permission:finance.manage')
        ->name('expenses.store');

    Route::get('expenses/{expense}', [ExpenseController::class, 'show'])
        ->middleware('permission:finance.view')
        ->name('expenses.show');

    Route::delete('expenses/{expense}', [ExpenseController::class, 'destroy'])
        ->middleware('permission:finance.manage')
        ->name('expenses.destroy');

});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
