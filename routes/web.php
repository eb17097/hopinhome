<?php

use App\Models\Listing;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ListingController;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    // Fetch all listings from the database (latest first)
    $listings = Listing::latest()->get();

    return view('welcome', ['listings' => $listings]);
});

//Route::get('/', function () {
//    // We will keep your hardcoded listings for now (we'll fix this later!)
//    $listings = [
//        (object) [
//            'id' => 1,
//            'title' => 'Sunny Loft in Riga',
//            'city' => 'Riga',
//            'price' => 50,
//            'image_url' => 'https://images.unsplash.com/photo-1502672260266-1c1ef2d93688',
//        ],
//        (object) [
//            'id' => 2,
//            'title' => 'Cozy Studio in Jurmala',
//            'city' => 'Jurmala',
//            'price' => 120,
//            'image_url' => 'https://images.unsplash.com/photo-1522708323590-d24dbb6b0267',
//        ],
//    ];
//
//    return view('welcome', ['listings' => $listings]);
//});

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
});

require __DIR__.'/auth.php';
