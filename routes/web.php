<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\GoogleController;
use App\Http\Controllers\AjaxAuthController;
use App\Http\Controllers\ListingController;
use App\Http\Controllers\RenterController;
use App\Http\Controllers\PropertyManagerController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\NotificationSettingController;
use App\Models\Listing;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::post('/ajax/login', [AuthenticatedSessionController::class, 'apiStore'])->name('ajax.login');
Route::post('/ajax/verify-login-2fa', [AuthenticatedSessionController::class, 'verifyLogin2fa'])->name('ajax.verify-login-2fa');
Route::post('/ajax/check-email', [AjaxAuthController::class, 'checkEmail'])->name('ajax.check-email');
Route::post('/ajax/send-otp', [AjaxAuthController::class, 'sendOtp'])->name('ajax.send-otp');
Route::post('/ajax/verify-otp', [AjaxAuthController::class, 'verifyOtp'])->name('ajax.verify-otp');
Route::post('/ajax/register', [AjaxAuthController::class, 'register'])->name('ajax.register');
Route::post('/ajax/forgot-password', [AjaxAuthController::class, 'sendResetLink'])->name('ajax.forgot-password');
Route::post('/ajax/reset-password', [AjaxAuthController::class, 'resetPassword'])->name('ajax.reset-password');

// Google Authentication Routes
Route::get('auth/google', [GoogleController::class, 'redirectToGoogle'])->name('auth.google');
Route::get('auth/google/callback', [GoogleController::class, 'handleGoogleCallback']);

Route::middleware('auth')->group(function () {
    Route::put('/notification-settings', [NotificationSettingController::class, 'update'])->name('notification-settings.update');
});

Route::get('/', function () {
    // Fetch all listings from the database (latest first)
    $listings = Listing::latest()->get();

    return view('welcome', ['listings' => $listings]);
})->name('home');

// IMPORTANT: Define specific routes like 'create' before parameterized routes like '{listing}'
Route::get('/listings/create', [ListingController::class, 'create'])->name('listings.create')->middleware('auth');
Route::get('/listings/{listing}', [ListingController::class, 'show'])->name('listings.show');
Route::get('/listings', [ListingController::class, 'index'])->name('listings.index');

Route::get('/dashboard', function () {
    $user = auth()->user();
    if ($user->isRenter()) {
        return redirect()->route('renter.index');
    } elseif ($user->isPropertyManager()) {
        return redirect()->route('property_manager.index');
    }
    return redirect()->route('home');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware(['auth'])->group(function () {
    // Profile Routes
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth', 'role:renter'])->prefix('renter')->name('renter.')->group(function () {
    Route::get('/', [RenterController::class, 'index'])->name('index');
});

Route::middleware(['auth', 'role:property_manager'])->prefix('property-manager')->name('property_manager.')->group(function () {
    Route::get('/', [PropertyManagerController::class, 'index'])->name('index');
    Route::get('/listings/create', [ListingController::class, 'create'])->name('listings.create');
    Route::post('/listings', [ListingController::class, 'store'])->name('listings.store');
    Route::delete('/listings/{listing}', [ListingController::class, 'destroy'])->name('listings.destroy');
    Route::get('/listings', [ListingController::class, 'myListings'])->name('listings.index');
});

require __DIR__.'/auth.php';
