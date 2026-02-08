<?php

namespace App\Http\Controllers;

use App\Models\Listing;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ListingController extends Controller
{
    // 1. Show the form
    public function create()
    {
        return view('listings.create');
    }

    // 2. Handle the upload
    public function store(Request $request)
    {
        // Validate the form data
        $request->validate([
            'title' => 'required',
            'city' => 'required',
            'price' => 'required|integer',
            'image' => 'required|image|max:2048', // Max 2MB file
        ]);

        // Upload to AWS S3
        $path = $request->file('image')->storePublicly('apartments', 's3');

        // Create the listing in the database
        Listing::create([
            'user_id' => auth()->id(),
            'title' => $request->title,
            'city' => $request->city,
            'price' => $request->price,
            'image_url' => Storage::disk('s3')->url($path), // Save the S3 link
        ]);

        return redirect()->route('dashboard')->with('success', 'Apartment posted!');
    }

    // 3. Show a single listing
    public function show(Listing $listing)
    {
        return view('listings.show', ['listing' => $listing]);
    }
}
