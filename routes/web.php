<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    $listings = [
        (object) [
            'id' => 1,
            'title' => 'Sunny Loft in Riga',
            'city' => 'Riga',
            'price' => 50,  // <-- Added this
            'image_url' => 'https://images.unsplash.com/photo-1502672260266-1c1ef2d93688',
        ],
        (object) [
            'id' => 2,
            'title' => 'Cozy Studio in Jurmala',
            'city' => 'Jurmala',
            'price' => 120, // <-- Added this
            'image_url' => 'https://images.unsplash.com/photo-1522708323590-d24dbb6b0267',
        ],
    ];

    return view('welcome', ['listings' => $listings]);
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
