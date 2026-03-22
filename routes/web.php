<?php

use App\Http\Controllers\OnboardingController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\GoogleController;
use App\Http\Controllers\AjaxAuthController;
use App\Http\Controllers\ListingController;
use App\Http\Controllers\ListingSearchController;
use App\Http\Controllers\RenterController;
use App\Http\Controllers\PropertyManagerController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\NotificationSettingController;
use App\Http\Controllers\RegionalPreferenceController;
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
    Route::get('/onboarding', [OnboardingController::class, 'index'])->name('onboarding.index');
    Route::get('/onboarding/back', [OnboardingController::class, 'back'])->name('onboarding.back');
    Route::get('/onboarding/skip', [OnboardingController::class, 'skip'])->name('onboarding.skip');
    Route::post('/onboarding/step-1', [OnboardingController::class, 'step1'])->name('onboarding.step1');
    Route::post('/onboarding/step-2', [OnboardingController::class, 'step2'])->name('onboarding.step2');
    Route::post('/onboarding/step-3', [OnboardingController::class, 'step3'])->name('onboarding.step3');
    Route::post('/onboarding/complete', [OnboardingController::class, 'complete'])->name('onboarding.complete');
    Route::put('/notification-settings', [NotificationSettingController::class, 'update'])->name('notification-settings.update');
    Route::put('/regional-preferences', [RegionalPreferenceController::class, 'update'])->name('regional-preferences.update');
    Route::post('/ajax/password/update', [\App\Http\Controllers\Auth\PasswordController::class, 'ajaxUpdate'])->name('ajax.password.update');
});

Route::get('/', function () {
    // Fetch all active listings from the database (latest first)
    $listings = Listing::where('status', 'Active')->latest()->get();
    $maxListingPrice = Listing::where('status', 'Active')->max('price') ?: 1000000;
    $maxListingArea = Listing::where('status', 'Active')->max('area') ?: 10000;

    $allFeatures = \App\Models\Feature::whereHas('listings', function($q) {
        $q->where('status', 'Active');
    })->orderBy('name')->get();

    $allAmenities = \App\Models\Amenity::whereHas('listings', function($q) {
        $q->where('status', 'Active');
    })->orderBy('name')->get();

    return view('welcome', [
        'listings' => $listings, 
        'maxListingPrice' => $maxListingPrice,
        'maxListingArea' => $maxListingArea,
        'allFeatures' => $allFeatures,
        'allAmenities' => $allAmenities
    ]);
})->name('home');

// Listing Routes
Route::get('/listings/create', [ListingController::class, 'create'])->name('listings.create')->middleware('auth');
Route::get('/listings/search/{location?}/{property_type?}/{bedrooms?}', [ListingSearchController::class, 'index'])->name('listings.search');
Route::get('/listings/{listing}', [ListingController::class, 'show'])->name('listings.show');
Route::get('/listings', [ListingController::class, 'index'])->name('listings.index');

// Public Profile Route
Route::get('/profile/pm/{id}', [\App\Http\Controllers\PublicProfileController::class, 'show'])->name('public_profile.show');

Route::get('/dashboard', function () {
    $user = auth()->user();

    if (!$user->onboarding_completed) {
        return redirect()->route('onboarding.index');
    }

    if ($user->isRenter()) {
        return redirect()->route('renter.index');
    } elseif ($user->isPropertyManager()) {
        return redirect()->route('property_manager.index');
    } elseif ($user->isBusinessOwner()) {
        return redirect()->route('business_owner.index');
    }
    return redirect()->route('home');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware(['auth'])->group(function () {
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth', 'role:renter'])->prefix('renter')->name('renter.')->group(function () {
    Route::get('/', [RenterController::class, 'index'])->name('index');
    Route::get('/security', [RenterController::class, 'security'])->name('security');
    Route::post('/mark-setup-complete', [RenterController::class, 'markSetupComplete'])->name('mark-setup-complete');
});

Route::middleware(['auth', 'role:business_owner'])->prefix('business-owner')->name('business_owner.')->group(function () {
    Route::get('/', [\App\Http\Controllers\BusinessOwnerController::class, 'index'])->name('index');
    Route::get('/profile', [\App\Http\Controllers\BusinessOwnerController::class, 'profile'])->name('profile');
    Route::get('/security', [\App\Http\Controllers\BusinessOwnerController::class, 'security'])->name('security');
});

Route::middleware(['auth', 'role:property_manager'])->prefix('property-manager')->name('property_manager.')->group(function () {
    Route::get('/', [PropertyManagerController::class, 'index'])->name('index');
    Route::get('/profile', [PropertyManagerController::class, 'profile'])->name('profile');
    Route::get('/security', [PropertyManagerController::class, 'security'])->name('security');
    Route::get('/listings/create', [ListingController::class, 'create'])->name('listings.create');
    Route::post('/listings', [ListingController::class, 'store'])->name('listings.store');
    Route::get('/listings/{listing}/edit', [ListingController::class, 'edit'])->name('listings.edit');
    Route::get('/listings/{listing}/preview', [ListingController::class, 'preview'])->name('listings.preview');
    Route::post('/listings/{listing}/publish', [ListingController::class, 'publish'])->name('listings.publish');
    Route::put('/listings/{listing}', [ListingController::class, 'update'])->name('listings.update');
    Route::delete('/listings/{listing}', [ListingController::class, 'destroy'])->name('listings.destroy');
    Route::get('/listings', [ListingController::class, 'myListings'])->name('listings.index');
});

require __DIR__.'/auth.php';
