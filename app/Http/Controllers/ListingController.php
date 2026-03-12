<?php

namespace App\Http\Controllers;

use App\Models\Listing;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
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

    public function store(Request $request)
    {
        Log::info('--- Starting Listing Creation Process ---');
        Log::info('Incoming Request Data:', $request->except('photos')); // Don't log file content

        // Decode JSON strings for features and amenities if they are present
        $features = json_decode($request->input('features'), true) ?? [];
        $amenities = json_decode($request->input('amenities'), true) ?? [];

        $request->merge([
            'features' => $features,
            'amenities' => $amenities,
        ]);

        $isDraft = $request->input('status') === 'Draft';
        
        try {
            $rules = [
                'name' => $isDraft ? 'nullable|string|max:255' : 'required|string|max:255',
                'property_type' => $isDraft ? 'nullable|string' : 'required|string',
                'address' => $isDraft ? 'nullable|string' : 'required|string',
                'description' => $isDraft ? 'nullable|string' : 'required|string',
                'bedrooms' => $isDraft ? 'nullable|string' : 'required|string',
                'bathrooms' => $isDraft ? 'nullable|integer|min:0' : 'required|integer|min:0',
                'area' => $isDraft ? 'nullable|integer|min:0' : 'required|integer|min:0',
                'floor_number' => 'nullable|integer|min:0',
                'total_floors' => 'nullable|integer|min:0',
                'construction_year' => $isDraft ? 'nullable|integer|min:0' : 'required|integer|min:0',
                'payment_option' => $isDraft ? 'nullable|string' : 'required|string',
                'utilities_option' => $isDraft ? 'nullable|string' : 'required|string',
                'price' => $isDraft ? 'nullable|numeric|min:0' : 'required|numeric|min:0',
                'duration' => $isDraft ? 'nullable|integer|min:0' : 'required|integer|min:0',
                'renewal_type' => $isDraft ? 'nullable|string' : 'required|string',
                'latitude' => 'nullable|numeric',
                'longitude' => 'nullable|numeric',
                'status' => 'nullable|string',
                'video_file' => 'nullable|file|mimes:mp4,mov,avi,wmv|max:51200', // 50MB Max
                'photos' => 'nullable|array',
                'photos.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                'features' => 'nullable|array',
                'features.*' => 'exists:features,id',
                'amenities' => 'nullable|array',
                'amenities.*' => 'exists:amenities,id',
            ];

            $validatedData = $request->validate($rules);

            // Ensure status is set correctly
            if ($isDraft) {
                $validatedData['status'] = 'Draft';
            } else {
                $validatedData['status'] = 'Active';
            }

            // Handle video upload
            if ($request->hasFile('video_file')) {
                $videoFile = $request->file('video_file');

                // Upload video to S3
                $videoS3Path = $videoFile->storePublicly('videos', 's3');
                $videoUrl = Storage::disk('s3')->url($videoS3Path);
                Log::info('Video uploaded to S3:', ['url' => $videoUrl]);

                $validatedData['video_url'] = $videoUrl;
            }

            DB::beginTransaction();

            $listing = auth()->user()->listings()->create($validatedData);

            if ($request->hasFile('photos')) {
                Log::info('Processing photo uploads...');
                foreach ($request->file('photos') as $index => $photo) {
                    Log::info('Uploading file:', ['original_name' => $photo->getClientOriginalName()]);
                    $path = $photo->storePublicly('apartments', 's3');
                    $url = Storage::disk('s3')->url($path);
                    Log::info('File stored on S3.', ['path' => $path, 'url' => $url]);
                    $listing->images()->create(['image_url' => $url, 'sequence' => $index]);
                }
            }

            if (!empty($validatedData['features'])) {
                $listing->features()->sync($validatedData['features']);
            }
            if (!empty($validatedData['amenities'])) {
                $listing->amenities()->sync($validatedData['amenities']);
            }

            DB::commit();

            Log::info('--- Listing Creation SUCCESS ---', ['listing_id' => $listing->id]);
            
            if ($request->filled('redirect_to')) {
                return redirect($request->input('redirect_to'))->with('success', 'Listing saved as draft!');
            }
            
            return redirect()->route('property_manager.index')->with('success', 'New listing created successfully!');

        } catch (\Illuminate\Validation\ValidationException $e) {
            // Laravel's validator handles the redirect. We just log the failure.
            Log::warning('--- Listing Creation FAILED: Validation Error ---', ['errors' => $e->errors()]);
            throw $e; // Re-throw to let Laravel handle the redirect
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('--- Listing Creation FAILED: An unexpected error occurred ---', [
                'error_message' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            return redirect()->back()->with('error', 'There was a critical error creating your listing. Please try again.')->withInput();
        }
    }
    
    // ... (other methods)
    // ... (other methods remain unchanged)

    // 3. Show a single listing
    public function show(Listing $listing)
    {
        $listing->load(['images', 'features', 'amenities', 'user']);
        return view('listings.show', ['listing' => $listing]);
    }

    // 4. Show all listings
    public function index(Request $request)
    {
        $query = Listing::query()->where('status', 'Active');

        if ($request->filled('location')) {
            $query->where(function($q) use ($request) {
                $q->where('address', 'like', '%' . $request->location . '%')
                  ->orWhere('name', 'like', '%' . $request->location . '%');
            });
        }

        if ($request->filled('property_types')) {
            $query->whereIn('property_type', $request->property_types);
        }

        if ($request->filled('bedrooms')) {
            $query->whereIn('bedrooms', $request->bedrooms);
        }

        if ($request->filled('min_price')) {
            $query->where('price', '>=', $request->min_price);
        }

        if ($request->filled('max_price')) {
            $query->where('price', '<=', $request->max_price);
        }

        $listings = $query->latest()->get();
        return view('listings.index', ['listings' => $listings]);
    }

    // 5. Show user's listings
    public function myListings()
    {
        return redirect()->route('property_manager.index');
    }

    public function destroy(Listing $listing)
    {
        // Authorize that the user owns the listing
        if (auth()->user()->id !== $listing->user_id) {
            abort(403, 'Unauthorized action.');
        }

        $listing->delete();

        return redirect()->route('property_manager.index')->with('success', 'Listing deleted successfully.');
    }
}
