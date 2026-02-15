<?php

use App\Models\Listing;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ListingController;
use App\Http\Controllers\ManagerController;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

Route::get('/', function () {
    // Fetch all listings from the database (latest first)
    $listings = Listing::latest()->get();

    return view('welcome', ['listings' => $listings]);
});

Route::get('/listings/{listing}', [ListingController::class, 'show'])->name('listings.show');

Route::get('/listings', [ListingController::class, 'index'])->name('listings.index');

Route::get('/migrate-prod', function () {
    \Illuminate\Support\Facades\Artisan::call('migrate', ['--force' => true]);
    return 'Migration run successfully!';
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    // Profile Routes
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Listing Routes (Added these!)
    Route::get('/listings/create', [ListingController::class, 'create'])->name('listings.create');
    Route::post('/listings', [ListingController::class, 'store'])->name('listings.store');

    // Manager Route
    Route::get('/manager', [ManagerController::class, 'index'])->name('manager.index');
});

require __DIR__.'/auth.php';
