<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\GoogleController;
use App\Http\Controllers\ListingController;
use App\Http\Controllers\ManagerController;
use App\Http\Controllers\ProfileController;
use App\Models\Listing;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::post('/ajax/login', [AuthenticatedSessionController::class, 'apiStore'])->name('ajax.login');

// Google Authentication Routes
Route::get('auth/google', [GoogleController::class, 'redirectToGoogle'])->name('auth.google');
Route::get('auth/google/callback', [GoogleController::class, 'handleGoogleCallback']);

Route::get('/', function () {
    // Fetch all listings from the database (latest first)
    $listings = Listing::latest()->get();

    return view('welcome', ['listings' => $listings]);
});

// IMPORTANT: Define specific routes like 'create' before parameterized routes like '{listing}'
Route::get('/listings/create', [ListingController::class, 'create'])->name('listings.create')->middleware('auth');
Route::get('/listings/{listing}', [ListingController::class, 'show'])->name('listings.show');
Route::get('/listings', [ListingController::class, 'index'])->name('listings.index');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    // Profile Routes
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Listing Routes
    Route::post('/listings', [ListingController::class, 'store'])->name('listings.store');
    Route::delete('/listings/{listing}', [ListingController::class, 'destroy'])->name('listings.destroy');

    // Manager Routes
    Route::get('/manager', [ManagerController::class, 'index'])->name('manager.index');
    Route::get('/manager/listings', [ListingController::class, 'myListings'])->name('manager.listings.index');
});

require __DIR__.'/auth.php';
