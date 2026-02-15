<?php

namespace App\Http\Controllers;

use App\Models\Listing;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class ListingController extends Controller
{
    // 1. Show the form
    public function create()
    {
        $propertyTypes = ['Apartment', 'Villa', 'House', 'Townhouse', 'Hotel apartment', 'Penthouse'];
        $features = \App\Models\Feature::all();
        $amenities = \App\Models\Amenity::all();
        return view('listings.create', compact('propertyTypes', 'features', 'amenities'));
    }

    // 2. Handle the multi-step form submission
    public function store(Request $request)
    {
        // Note: For a real application, using a Form Request for validation is recommended.
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'property_type' => 'required|string',
            'address' => 'required|string',
            'description' => 'required|string',
            'bedrooms' => 'required|string',
            'bathrooms' => 'required|integer',
            'area' => 'required|integer',
            'floor_number' => 'nullable|integer',
            'total_floors' => 'nullable|integer',
            'construction_year' => 'required|integer',
            'payment_option' => 'required|string',
            'utilities_option' => 'required|string',
            'price' => 'required|numeric',
            'duration' => 'required|integer',
            'renewal_type' => 'required|string',
            'video_url' => 'nullable|url',
            'photos' => 'nullable|array',
            'photos.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'features' => 'nullable|array',
            'features.*' => 'exists:features,id',
            'amenities' => 'nullable|array',
            'amenities.*' => 'exists:amenities,id',
        ]);

        try {
            DB::beginTransaction();

            $listing = auth()->user()->listings()->create($validatedData);

            if ($request->hasFile('photos')) {
                foreach ($request->file('photos') as $photo) {
                    $path = $photo->store('listings', 'public');
                    $listing->images()->create(['image_url' => Storage::url($path)]);
                }
            }

            if (!empty($validatedData['features'])) {
                $listing->features()->sync($validatedData['features']);
            }
            if (!empty($validatedData['amenities'])) {
                $listing->amenities()->sync($validatedData['amenities']);
            }

            DB::commit();

            return redirect()->route('manager.listings.index')->with('success', 'New listing created successfully!');

        } catch (\Exception $e) {
            DB::rollBack();
            logger()->error($e->getMessage());
            return redirect()->back()->with('error', 'There was an error creating your listing. Please try again.')->withInput();
        }
    }
    // ... (other methods remain unchanged)

    // 3. Show a single listing
    public function show(Listing $listing)
    {
        return view('listings.show', ['listing' => $listing]);
    }

    // 4. Show all listings
    public function index()
    {
        $listings = Listing::latest()->get();
        return view('listings.index', ['listings' => $listings]);
    }

    // 5. Show user's listings
    public function myListings()
    {
        $listings = auth()->user()->listings()->latest()->get();
        return view('manager.listings.index', ['listings' => $listings]);
    }
}
