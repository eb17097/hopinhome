<?php

use App\Models\Listing;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    // Fetch all apartments from the database
    $listings = Listing::all();

    // Send them to the view
    return view('welcome', ['listings' => $listings]);
});
